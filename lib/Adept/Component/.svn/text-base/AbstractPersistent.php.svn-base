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

abstract class Adept_Component_AbstractPersistent extends Adept_Component_AbstractBase 
    implements Adept_Component_StatePersister
{

    protected $stateProperties = null;
    
    protected function getStateProperty($name, $defaultValue = null)
    {
//        if ($this->stateProperties instanceof Adept_Map && $this->stateProperties->has($name)) {
//            return $this->stateProperties->get($name);
//        } else {
//            $expr = $this->getValueExpression($name);
//            if (null !== $expr) {
//                return $expr->getValue($this->getExpressionContext());
//            } 
//            return $defaultValue;
//        }
        return $this->getProperty($name, $defaultValue);
    }
    
    protected function setStateProperty($name, $value)
    {
//        if ($value instanceof Adept_Expression_Evaluable) {
//            $this->resetStateProperty($name);
//            $this->bindings[$name] = $value;
//            return ;
//        } 
//            
//        if ($this->stateProperties === null) {
//            $this->stateProperties = new Adept_Map();
//        }
//        
//        $this->stateProperties->set($name, $value);
        $this->setProperty($name, $value);
    }
    
    public function resetStateProperty($name)
    {
//        if ($this->stateProperties instanceof Adept_Map) {
//            $this->stateProperties->remove($name);
//        }
//        $this->setValueExpression($name, null);
        $this->resetProperty($name);
    }
    
    public function getCookieId()
    {
        return $this->getRootView()->getUniqueId() . "_" . $this->getClientId();
    }
    
    // StatePersister interface -----------------------------------------------

    /**
     * Restore component state
     *
     * @param Adept_Map $state
     */
    public function restoreState($state)
    {
        if (!$state instanceof Adept_Map) {
            return ;
        }
        
        foreach ($this->getProperyDecriptions() as $name => $description) {
            if ($description->isPersistent()) {
                $value = $state->get($name);
                if (null !== $value) {
                    $this->setProperty($name, $value);
                }
            }
        }
    } 
    
    public function saveState()
    {
        $state = new Adept_CanonicalMap();
        foreach ($this->getProperyDecriptions() as $name => $description) {
            if ($description->isPersistent()) {
                $value = $this->getLocalProperty($name);
                if (null !== $value) {
                    $state->set($name, $value);
                }
            }
        }
        return $state;
    }           
    
    // Lifecycle phases -------------------------------------------------------
    
    public function processRestoreState()
    {
        if ($this->isPersistent()) {
            $state = $this->getRootView()->getStateStorage()->load($this->getId());
            if ($state !== null) {
                $this->restoreState($state);
            }
        }
        parent::processRestoreState();
    }
    
    public function processSaveState()
    {
        if ($this->isPersistent()) {
            $state = $this->saveState();
            if ($state !== null) { 
                $this->getRootView()->getStateStorage()->save($this->getId(), $state);
            }
        }
        parent::processSaveState();        
    }

}