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

class Adept_Component_Form extends Adept_Component_AbstractControl implements 
    Adept_Component_DomContainer, Adept_Component_NamingContainer 
{

    const INIT_EVENT = 'init';
    const SUBMIT_EVENT = 'submit';
    const VALID_EVENT = 'valid';
    const INVALID_EVENT = 'invalid';

    // Event listeners --------------------------------------------------------
    
    public function addInitListener($listener)
    {
        $this->addEventListener(self::INIT_EVENT, $listener);
    }

    public function addSubmitListener($listener)
    {
        $this->addEventListener(self::SUBMIT_EVENT, $listener);
    }
    
    public function addValidListener($listener)
    {
        $this->addEventListener(self::VALID_EVENT, $listener);
    }

    public function addInvalidListener($listener)
    {
        $this->addEventListener(self::INVALID_EVENT, $listener);
    }
   
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('namingContainer', array(), false);
        $this->addPropertyDescription('ajax', array(), false);
        $this->addPropertyDescription('submitted', array(self::CAP_CLIENT), false);
        $this->addPropertyDescription('valid', array(self::CAP_CLIENT), true);
        $this->addPropertyDescription('accept', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('acceptCharset', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('action', array(self::CAP_PERSISTENT), '', self::TYPE_STRING);
        $this->addPropertyDescription('method', array(self::CAP_PERSISTENT), 'post', self::TYPE_STRING);
        $this->addPropertyDescription('enctype', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('target', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('controllerNeeded', array(), false);
    }

    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form';
    }
    
    public function invokeApplication()
    {
        if ($this->isSubmitted()) {
            $this->markDirty();
            $this->queueEvent(new Adept_Event_FormSubmit($this));
            if ($this->isValid()) {
                $this->queueEvent(new Adept_Event_FormValid($this));
            } else {
                $this->queueEvent(new Adept_Event_FormInvalid($this));
            }
        } else {
            // Initialize form only if rendered
            if ($this->isRendered() && !$this->getRootView()->isAlreadyLoaded()) {
                $this->queueEvent(new Adept_Event_FormInit($this));            
            }
        }
    }
    
    public function getDomContainerId()
    {
        return $this->getClientId() . Adept_Component_NamingContainer::SEPARATOR . "FormHolder";
    }
    
    // NamingContainer --------------------------------------------------------
    
    public function getNamingContainerId()
    {
        if ($this->isNamingContainer()) {
            return $this->getClientId();
        } else {
            return null;
        }
    }
    
    public function isNamingContainer() 
    {
        return $this->getProperty('namingContainer', false);
    }
    
    public function setNamingContainer($namingContainer)
    {
        $this->setProperty('namingContainer', $namingContainer);
    }
    
    public function defineBrowserEvents()
    {
        return array(
            Adept_Component_BrowserEvent::ON_SUBMIT,
            Adept_Component_BrowserEvent::ON_RESET
        );
    }
    
    // Attributes -------------------------------------------------------------
    
    public function isSubmitted()
    {
        return $this->getProperty('submitted');
    }
    
    public function setSubmitted($submitted)
    {
        $this->setProperty('submitted', $submitted);
    }
    
    public function isValid()
    {
        return $this->getProperty('valid', true);
    }
    
    public function setValid($valid)
    {
        $this->setProperty('valid', $valid);
    }

    // Properties -------------------------------------------------------------
    
    public function getAccept() 
    {
        return $this->getProperty('accept');
    }
    
    public function setAccept($accept)
    {
        $this->setProperty('accept', $accept);
    }
    
    public function getAcceptCharset() 
    {
        return $this->getProperty('acceptCharset');
    }
    
    public function setAcceptCharset($acceptCharset)
    {
        $this->setProperty('acceptCharset', $acceptCharset);
    }
    
    public function getAction() 
    {
        return $this->getProperty('action');
    }
    
    public function setAction($action)
    {
        $this->setProperty('action', $action);
    }
    
    public function isAjax() 
    {
        return $this->getProperty('ajax', false);
    }
    
    public function setAjax($ajax)
    {
        $this->setProperty('ajax', $ajax);
        $this->setControllerNeeded(true);
    }
    
    public function getMethod() 
    {
        return $this->getProperty('method', 'post');
    }
    
    public function setMethod($method)
    {   
        $this->setProperty('method', $method);
    }
    
    public function getEnctype() 
    {
        return $this->getProperty('enctype');
    }
    
    public function setEnctype($enctype)
    {
        $this->setProperty('enctype', $enctype);
    }
    
    public function getTarget() 
    {
        return $this->getProperty('target');
    }
    
    public function setTarget($target)
    {
        $this->setProperty('target', $target);
    }
    
    public function isControllerNeeded() 
    {
        
        return $this->getProperty('controllerNeeded');
    }
    
    public function setControllerNeeded($controllerNeeded) 
    {
        $this->setProperty('controllerNeeded', $controllerNeeded);
    }
    
}
