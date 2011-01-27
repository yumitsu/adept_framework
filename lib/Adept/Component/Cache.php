<?php

/**
 * Adept Framework
 *
 * LICENSE
 *
 * This source file is subject to the BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://adept-project.com/license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@adept-project.com so we can send you a copy immediately.
 *
 * @category   Adept
 * @package    Adept_Component
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Component_Cache extends Adept_Component_AbstractBase 
{
    
    const DEFAULT_CACHE_GROUP = 'Adept_Component_Cache';
    const CACHE_STRATEGY = 'Adept_Component_Cache';
    
    const NOCACHE_CLASS = 'Adept_Component_NoCache';
    
    private $_noCacheBlocks = null;
    private $_capturing = false;
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('key', array());
        $this->addPropertyDescription('group', array(), self::DEFAULT_CACHE_GROUP);
        $this->addPropertyDescription('lifeTime', array(), 3600);
        $this->addPropertyDescription('valid', array(), true);
        $this->addPropertyDescription('forceProcess', array(), false);
    }
    
    protected function getUniqueId()
    {
        return $this->getRootView()->getUniqueId() . '_' .  $this->getClientId();
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
    /**
     * Returns true if data exist in cache and valid, false otherwise
     * 
     * @return bool
     */
    protected function isCached()
    {
        $cacheService = $this->getCacheService();
        if ($cacheService === null){
            return false;
        }
        if (!$this->isValid()){
            return false;
        }
        return $cacheService->test($this->getCachedId());
    }
    
    /**
     * @return Zend_Cache_Core
     */
    public function getCacheService()
    {
        return Adept_Cache::getInstance()->getService(self::CACHE_STRATEGY);
    }
    
    protected function getCachedId()
    {
        $keyId = $this->getKey() !== null ? $this->getKey() : $this->getUniqueId();
         
        return  $keyId . '_' . $this->getGroup();
    }
    
    protected function loadContent()
    {
        $service = $this->getCacheService();
        if ($service === null) {
            return null;
        }
        return $service->load($this->getCachedId());
    }
    
    protected function saveContent($content)
    {
        $service = $this->getCacheService();
        if ($service === null) {
            return null;
        }
        return $service->save($content, $this->getCachedId(), array(), $this->getLifeTime());
    }
    
    /**
     * Used for flush cache data manualy. 
     *
     * @return bool
     */
    public function flushCache()
    {
        $service = $this->getCacheService();
        if ($service === null) {
            return false;
        }
        return $service->remove($this->getCachedId());
    }
    
    protected function captureRender()
    {
        $response = Adept_Context::getInstance()->getResponse();
        $response->startCapture();
        
        $this->_capturing = true;
        
        parent::renderChildren();
        
        $this->_capturing = false;
        
        return $response->endCapture()->getContent();
    }
    
    public function getNoCacheBlocks()
    {
        if ($this->_noCacheBlocks === null) {
            $this->_noCacheBlocks = $this->findChildrenByClass(self::NOCACHE_CLASS);
        }
        return $this->_noCacheBlocks;
    }
    
    // Phases ------------------------------------------------------------------

    public function processHandleRequest()
    {
        if ($this->isForceProcess() || !$this->isCached()) {
            parent::processHandleRequest();
        } else {
            foreach ($this->getNoCacheBlocks() as $component) {
                $component->processHandleRequest();
            }
        }
    }
    
    public function processValidation()
    {
        if ($this->isForceProcess() || !$this->isCached()) {
            parent::processValidation();
        } else {
            foreach ($this->getNoCacheBlocks() as $component) {
                $component->processValidation();
            }
        }
    }

    public function processUpdateModel()
    {
        if ($this->isForceProcess() || !$this->isCached()) {
            parent::processUpdateModel();
        } else {
            foreach ($this->getNoCacheBlocks() as $component) {
                $component->processUpdateModel();
            }            
        }
    }

    public function processInvokeApplication()
    {
        if ($this->isForceProcess() || !$this->isCached()) {
            parent::processInvokeApplication();
        } else {
            foreach ($this->getNoCacheBlocks() as $component) {
                $component->processInvokeApplication();
            }            
        }
    }
    
    public function renderChildren()
    {   
        $response = Adept_Context::getInstance()->getResponse();
        
        $content = '';
        
        if ($this->isCached()) {
            $content = $this->loadContent();
        } else {
            $content = $this->captureRender();
            $this->saveContent($content);
        }
        
        // Render and NoCache and insert content 
        foreach ($this->getNoCacheBlocks() as $noCache) {
            $content = str_replace($noCache->getPlaceMarker(), $noCache->renderContents(), $content);
        }
        
        $response->write($content);
    }
    
    public function renderAjax()
    {
        if (!$this->isCached()) {
            parent::renderAjax();
        } else {
            foreach ($this->getNoCacheBlocks() as $component) {
                $component->renderAjax();
            }
        }
    }
    
    // Properies --------------------------------------------------------------
    
    public function isCapturing() 
    {
        return $this->_capturing;
    }
    
    public function getKey() 
    {
       return $this->getProperty('key');
    }
    
    public function setKey($key) 
    {
       $this->setProperty('key', $key);
    }
    public function getGroup() 
    {
       return $this->getProperty('group');
    }
    
    public function setGroup($group) 
    {
       $this->setProperty('group', $group);
    }
    
    public function getLifeTime() 
    {
       return $this->getProperty('lifeTime');
    }
    
    public function setLifeTime($lifeTime) 
    {
       $this->setProperty('lifeTime', $lifeTime);
    }
    
    public function isValid() 
    {
       return $this->getProperty('valid');
    }
    
    public function setValid($valid) 
    {
       $this->setProperty('valid', $valid);
    }
    
    public function isForceProcess() 
    {
       return $this->getProperty('forceProcess');
    }
    
    public function setForceProcess($forceProcess) 
    {
       $this->setProperty('forceProcess', $forceProcess);
    }
    
}
