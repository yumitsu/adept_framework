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

class Adept_Component_Object_Factory extends Adept_Component_AbstractBase
{

    protected $object;
    
    protected $class = null;
    protected $name = null;
    protected $require = null;

    public function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('name');
        $this->addPropertyDescription('class');
        $this->addPropertyDescription('proxy');
        $this->addPropertyDescription('require');
        $this->addPropertyDescription('global', array(), false);
    }
    
    public  function doSet()
    {
        if ($this->isGlobal()) {
            $this->getContext()->setAttribute($this->getName(), $this->getObject());
        } else {
            $this->getExpressionContext()->set($this->getName(), $this->getObject());    
        }
    }
    
    public function getObject()
    {
        if ($this->object == null) {
            if ($this->getRequire() !== null) {
                require_once($this->getRequire());
            }
            
            $class = $this->getClass();
            $this->object = new $class();
        
            if($this->isProxy()) {
                $proxyFactory = Adept_Aop_ProxyFactory::getInstance();
                $this->object = $proxyFactory->getAdvicedObject($this->object);
            }
        }
        return $this->object;
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
    // Phases -----------------------------------------------------------------

    public function init()
    {
        $this->doSet();
    }
    
//    //FIXME remove this
//    public function processRestoreState()
//    {
//    	parent::processRestoreState();
//    	
//    	$this->doSet();
//    }
    
    
    public function handleRequest()
    {
        $this->doSet();
    }
    
    /**
     * @param Adept_Component_ObjectFactory $component
     */
    public function renderBegin() 
    {
        $this->doSet();
    }
    
    // Getters-Setters-------------------------------------------------------
    
    public function getClass() 
    {
        return $this->getProperty('class');
    }
    
    public function setClass($class)
    {
        $this->setProperty('class', $class);
    }
    
    public function getName() 
    {
        return $this->getProperty('name');
    }
        
    public function setName($name)
    {
        $this->setProperty('name', $name);
    }
    
    public function isProxy() 
    {
        return $this->getProperty('proxy', false);
    }
        
    public function setProxy($proxy)
    {
        $this->setProperty('proxy', $proxy);
    }
    
    public function getRequire() 
    {
        return $this->getProperty('require');
    }
    
    public function setRequire($require)
    {
        $this->setProperty('require', $require);
    }
    
    public function isGlobal() 
    {
        return $this->getProperty('global');
    }
    
    public function setGlobal($global) 
    {
        $this->setProperty('global', $global);
    }
    
    
}