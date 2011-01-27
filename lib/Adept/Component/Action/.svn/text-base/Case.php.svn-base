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

class Adept_Component_Action_Case extends Adept_Component_AbstractCommand  
{

    const ACTION_EVENT_EVENT = 'actionEvent';
    
    
    protected  function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('current', array(self::CAP_CLIENT), false);
    }
    
    public function addActionEventListener($listener)
    {
        $this->addEventListener(self::ACTION_EVENT_EVENT, $listener);
    }
    
    /**
     * @return Adept_Component_Action_Trigger
     */
    public function getActionTrigger()
    {
        $trigger = $this->findParentByClass('Adept_Component_Action_Trigger');
        if ($trigger == null) {
            throw new Adept_Exception_IllegalState('Cannot find parent Action Trigger.'
                . ' Action Case can be used inside Action Trigger only');
        }
        return $trigger;
    }
    
    protected function isActionEquals()
    {
        $actionName = $this->getActionName();
        if (trim($actionName) == '') {
           return false;
        }
        $trigger = $this->getActionTrigger();
        return strcasecmp($trigger->getActionName(), $this->getActionName()) == 0;
    }
    
    public function handleRequest()
    {
        $trigger = $this->getActionTrigger();
        if ($this->isActionEquals()) {
            $this->setCurrent(true);
            $trigger->setProcessed(true);
        } else {
            $this->setCurrent(false);
        }
    }

    public function invokeApplication()
    {
        if ($this->isCurrent() && $this->isValid()) {
            // @todo Mark dirty
            $event = new Adept_Event_ActionEvent($this, $this->getActionName());
            $this->queueEvent($event);
            $this->queueAction();
        }
    }

    public function renderChildren()
    {
        if ($this->isCurrent()) {
            parent::renderChildren();
        }
    }
    
    public function defineBrowserEvents()
    {
        return array();
    }

    public function isCurrent() 
    {
        return $this->getProperty('current');
    }
    
    public function setCurrent($current)
    {
        $this->setProperty('current', $current);
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
}
