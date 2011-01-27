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

class Adept_Component_Action_Trigger extends Adept_Component_AbstractPersistent  
{
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('actionName', array(self::CAP_CLIENT), null);
        $this->addPropertyDescription('processed', array(self::CAP_CLIENT), false);
        $this->addPropertyDescription('param');
    }
    
    public function getActionName() 
    {
        return $this->getProperty('actionName');
    }
    
    public function setActionName($actionName)
    {
        $this->setProperty('actionName', $actionName);
    }
    
    public function handleRequest() 
    {
        $request = Adept_Context::getInstance()->getRequest();
        if ($this->getParam() !== null) {
            $this->setActionName($request->get($this->getParam()));
        } else {
            $this->setActionName($request->getAction());
        }
    }    
    
    public function hasRenderer()
    {
        return false;
    }
    
    public function renderChildren()
    {
        parent::renderChildren();
        
        if (!$this->isProcessed()) {
            $defaultFacet = $this->getFacet('default');
            if (null !== $defaultFacet) {
                $defaultFacet->render();
            }
        }
    }   
    
    // Properties -------------------------------------------------------------
    
    public function getParam() 
    {
        return $this->getProperty('param', 'action');
    }
    
    public function setParam($param)
    {
        $this->setProperty('param', $param);
    }
    
    public function isProcessed() 
    {
        $this->getProperty('processed');
    }
    
    public function setProcessed($processed) 
    {
        $this->setProperty('processed', $processed);
    }
    
}
