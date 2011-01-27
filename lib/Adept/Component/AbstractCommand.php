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

/**
 * @todo Correct validation scheme.
 *
 */
abstract class Adept_Component_AbstractCommand extends Adept_Component_AbstractControl 
    implements Adept_Component_ActionSource 
{

    protected  function defineProperties()
    {
        parent::defineProperties();
        
        $this->addPropertyDescription('immediate', array(), false, self::TYPE_BOOL);
        $this->addPropertyDescription('action');
        $this->addPropertyDescription('actionName');
        $this->addPropertyDescription('alwaysValid', array(), false, self::TYPE_BOOL);
        $this->addPropertyDescription('validator', array());
        $this->addPropertyDescription('valid', array(self::CAP_CLIENT), true, self::TYPE_BOOL);
    }
    
    protected function generateActionName()
    {
        return $this->getClientId() . 'Action';
    }

    // Attributes -------------------------------------------------------------

    public function isValid()
    {
        return $this->getProperty('valid');
    }
    
    public function setValid($valid)
    {
        $this->setProperty('valid', $valid);
    }
    
    // ActionSource -----------------------------------------------------------

    public function isImmediate()
    {
        return $this->getProperty('immediate', false);
    }
    
    public function setImmediate($immediate)
    {
        $this->setProperty('immediate', $immediate);
    }
    
    /**
     * @return Adept_Expression_MethodBinding
     */
    public function getAction()
    {
        return $this->getMethodBinding('action');
    }
    
    public function setAction($expression)
    {
        $this->setProperty('action', $expression);
    }
    
    
    public function getActionName() 
    {
        $actionName = $this->getProperty('actionName');
        if ($actionName === null) {
            return $this->generateActionName();
        }
        return $actionName;
    }
    
    public function setActionName($actionName)
    {
        $this->setProperty('actionName', $actionName);
    }
    
    public function queueAction()
    {
        $action = new Adept_Event_Action($this, $this->getActionName());
        $this->queueEvent($action);
    }
    
    public function broadcast($event)
    {
        if ($event instanceof Adept_Event_Action) {
            $binding = $this->getAction();
            if ($binding != null) {
                $binding->invoke($this->getExpressionContext(), array());
            }
        } else {
            parent::broadcast($event); 
        }
    }
    
    // Validation -------------------------------------------------------------
    
    /**
     * Checks if component allow to invoke application. 
     * 
     * 1. If alwaysValid property is defined end equals true component
     * is valid.
     * 2. If defined validator MethodBinding, invoke it and if result is false,
     * marks component as invalid. 
     * 3. If command has a parent form, mark this component as invalid if form
     * if invalid. 
     * 4. If nothing before then component valid.
     */
    public function validate()
    {
        $this->setValid(true);
        
        // Step 1
        
        // Return if button "always valid" flag true
        if ($this->isAlwaysValid()) {
            return ;
        }
        // Step 2
        if ($this->isValid()) {
            // Use validate binding method 
            $binding = $this->getMethodBinding('validator');
            
            if ($binding !== null) {
                $result = $binding->invoke($this->getExpressionContext(), array($this));
            
                if ($result === false) {
                    $this->setValid(false);
                    return ;
                }
            }
        }
        // Step 3
        if ($this->isValid() && ($form = $this->getForm()) !== null) {
            if (!$form->isValid()) {
                $this->setValid(false);
            }
        }
    }    
    
    // Properties -------------------------------------------------------------
    
    public function isAlwaysValid() 
    {
        return $this->getProperty('alwaysValid');
    }
    
    public function setAlwaysValid($alwaysValid)
    {
        $this->setProperty('alwaysValid', $alwaysValid);
    }    
    
    public function getValidator() 
    {
        return $this->getProperty('validator');
    }
    
    public function setValidator($validator)
    {
        $this->setProperty('validator', $validator);
    }
    
}
