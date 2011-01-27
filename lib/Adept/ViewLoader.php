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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_ViewLoader 
{
    
    const TEMPLATE = 'tpl';
    const CACHE_SERVICE = 'Adept_Controller_Lifecycle';
    const CACHE_GROUP = 'Adept_Controller_Lifecycle';
    
    protected static $instance = null;
    
    protected function __construct()
    {
    }
    
    /**
     * @return Adept_ViewLoader
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }        
    
    public function loadTemplate($tpl)
    {
        $root = null;
        if ($this->isCacheValid($tpl)) {
            $root = $this->getCacheService()->load(md5(self::CACHE_GROUP . '_' . $tpl));
        } else {
            $template = new Adept_Template_ViewExecutor($tpl);
            $root = $template->getRootView();
            if ($this->isCached()) {
                $this->getCacheService()->save($root, md5(self::CACHE_GROUP . '_' . $tpl));            
            }  
        }
        return $root;
    }
    
    /**
     * @return Zend_Cache_Core
     */
    protected function getCacheService()
    {
        return Adept_Cache::getInstance()->getService(self::CACHE_SERVICE);
    }
    
    protected function isCached()
    {
        $service = $this->getCacheService();
        return $service !== null;
    }
    
    protected function isCacheValid($template)
    {
        if ($this->isCached()) {
            return $this->getCacheService()->test(md5(self::CACHE_GROUP . '_' . $template));
        } else {
            return false;
        }
    }    
        
}

