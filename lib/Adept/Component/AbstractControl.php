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

abstract class Adept_Component_AbstractControl extends Adept_Component_AbstractPersistent 
{
    
    // Control properties ------------------------------------------------------

    protected $alt = null;
    protected $cssClass = null;
    protected $cssStyle = null;    
    protected $disabled = null;
    protected $title = null;

    /**
     * @var Adept_Map
     */
    protected $browserEvents = null;
    
    protected $supportedBrowserEvents = null;
    
    // Browser events API methods ---------------------------------------------
    
    public function defineBrowserEvents()
    {
        return array();
    }
    
    public function getSupportedBrowserEvents()
    {
        if (is_null($this->supportedBrowserEvents)) {
            $this->supportedBrowserEvents = $this->defineBrowserEvents();
        }
        return $this->supportedBrowserEvents;
    }
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('title', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('alt', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('cssClass', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('cssStyle', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('disabled', array(self::CAP_PERSISTENT), false, self::TYPE_BOOL);
    }

    public function getBrowserEvent($name)
    {
        $name = strtolower($name);
        if (!in_array($name, $this->getSupportedBrowserEvents())) {
            throw new Adept_Exception_IllegalArgument('Unsupported browser event name', array('name' => $name));
        }
        return $this->getProperty($name);
    }

    public function setBrowserEvent($name, $event)
    {
        $name = strtolower($name);
        if (!in_array($name, $this->getSupportedBrowserEvents())) {
            throw new Adept_Exception_IllegalArgument('Unsupported browser event name', array('name' => $name));
        }
        $this->setProperty($name, $event);
    }
    
    public function setBrowserEventBindingString($name, $bindingString)
    {
        if ($this->bindings === null) {
            $this->bindings = new Adept_Map();
        }
        $this->bindings->set($name, Adept_Expression_Factory::getInstance()->createExpression($bindingString));
    }
    
    public function getBrowserEvents()
    {
        $result = array();
        foreach ($this->getSupportedBrowserEvents() as $eventName) {
            $event = $this->getBrowserEvent($eventName);
            if ($event != null) {
                $result[$eventName] = $event;
            }
        }
        return $result;
    }
  
    
    // Lifecycle --------------------------------------------------------------
    
    // Misc functions ---------------------------------------------------------

    /**
     * Returns parent form object if any.
     *
     * @return Adept_Component_Form
     */
    public function getForm()
    {
        return $this->findParentByClass('Adept_Component_Form');
    }
    
    // Control properties -------------------------------------------------------
    
    public function getAlt() 
    {
        return $this->getProperty('alt');
    }
    
    public function setAlt($alt)
    {
        $this->setProperty('alt', $alt);
    }

    public function getCssClass() 
    {
        return $this->getProperty('cssClass');
    }
    
    public function setCssClass($cssClass)
    {
        $this->setProperty('cssClass', $cssClass);
    }
    
    public function getCssStyle() 
    {
        return $this->getProperty('cssStyle');
    }
    
    public function setCssStyle($cssStyle)
    {
        $this->setProperty('cssStyle', $cssStyle);
    }
    
    public function isDisabled() 
    {
        return $this->getProperty('disabled', false);
    }
    
    public function setDisabled($disabled)
    {
        $this->setProperty('disabled', $disabled);
    }
    
    public function enable()
    {
        $this->setDisabled(false);
    }
    
    public function disable()   
    {
        $this->setDisabled(true);
    }
    
    public function getTitle() 
    {
        return $this->getProperty('title');
    }
    
    public function setTitle($title)
    {
        $this->setProperty('title', $title);
    }
    
}
