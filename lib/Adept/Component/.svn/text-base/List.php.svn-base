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

class Adept_Component_List extends Adept_Component_AbstractCycle
    implements Adept_Component_NamingContainer, Adept_Component_Cycle_CycleObserver 
{

    const SEPARATOR_FACET = 'separator';
    const DEFAULT_FACET = 'default';
    
    protected $currentPhase;
    
    protected $iterator = null;
    protected $listProperties;
    
    protected $key;
    protected $value;
    
    public function getNamingContainerId()
    {
        return $this->getClientId() . Adept_Component_NamingContainer::SEPARATOR  
            . $this->getListProperties()->getIndex();   
    }

    // Adept_Component_AbstractCycle -----------------------------------------
       
    /**
     * Cast getFrom() to iterator and return it.
     *
     * @return Iterator
     */
    public function createCycleIterator()
    {
        return new Adept_Component_List_Iterator($this, $this->getListSource());
    }
    
    /**
     * @return Adept_Component_List_Properties
     */
    public function getListProperties()
    {
        if ($this->listProperties == null) {
            $this->listProperties = new Adept_Component_List_Properties();
        }
        return $this->listProperties;
    }    
    
    // Adept_Component_AbstractCycle_CycleObserver -------------------------
    
    /**
     * @param Iterator $iterator
     */
    public function beforeIterateChildren($iterator)
    {
        $this->updateKeyAndValue($iterator->key(), $iterator->current());
        
        $current = new Adept_Model_ListIteration($this->getListProperties()->getIndex(), 
            $this->getCycleIterator()->key(), $this->getCycleIterator()->current());
        $this->setCurrentIteration($current);
    }

    /**
     * @param Iterator $iterator
     * @param Adept_Component_AbstractComponent $child
     * @param int $iteration 
     */
    public function iterateChild($iterator, $child, $iteration)
    {
        $this->getListProperties()->setIndex($iteration);
        Adept_Lifecycle_PhaseInvoker::processPhase($child, $this->currentPhase);
    }
    
    /**
     * @param Iterator $iterator
     */
    public function afterIterateChildren($iterator)
    {
        $separator = $this->getFacet(self::SEPARATOR_FACET);
        if ($separator != null && !$this->getListProperties()->isLast()) {
            Adept_Lifecycle_PhaseInvoker::processPhase($separator, $this->currentPhase);
        }
    }
    
    public function nothingToIterate($iterator)
    {
        $default = $this->getFacet(self::DEFAULT_FACET);
        if ($default) {
            Adept_Lifecycle_PhaseInvoker::processPhase($default, $this->currentPhase);    
        }
    }
    
    // Events features --------------------------------------------------------
    
    public function broadcast($event)
    {
        if ($event instanceof Adept_Event_ListWrapped) {
            $this->setCurrentIteration($event->getIteration());
            
            $event = $event->getWrapped();
            $event->broadcast();
        } else {
            parent::broadcast($event);
        }
    }
    
    public function queueEvent($event)
    {
        // Wrap event
        $current = new Adept_Model_ListIteration($this->getListProperties()->getIndex(), 
            $this->getCycleIterator()->key(), $this->getCycleIterator()->current());
            
        $wrapped = new Adept_Event_ListWrapped($this, $event, $current);
        
        parent::queueEvent($wrapped);
    }
        
    // ------------------------------------------------------------------------
    
    public function processPhase($phaseId)
    {
        if (($phaseId != Adept_Lifecycle_PhaseId::RENDER && $phaseId != Adept_Lifecycle_PhaseId::RENDER_AJAX) && $this->isRenderOnly()) {
            return ;
        }    
        $this->currentPhase = $phaseId;
        
       $this->iterateChildren($this);
    }
    
    /**
     * Set application binding value. 
     *
     * @param Adept_Model_ListIteration $cursrent
     */
    public function setCurrentIteration($current)
    {
        $binding = $this->getValueBinding('current');
        if (null != $binding) {
            $binding->setValue($this->getExpressionContext(), $current);
        }
        
        $binding = $this->getValueBinding('currentKey');
        if (null != $binding) {
            $binding->setValue($this->getExpressionContext(),$current->getKey());
        }
        
        $binding = $this->getValueBinding('currentValue');
        if (null != $binding) {
            $binding->setValue($this->getExpressionContext(),$current->getValue());
        }
        
        $this->getListProperties()->setIndex($current->getIndex());
    }
    
    public function getSelected() 
    {
        return $this->getProperty('selected');
    }
    
    public function setSelected($selected) 
    {
        $this->setProperty('selected', $selected);
    }
    
    public function findChildByClientId($clientId, $recursive = true)
    {
        $iteration = 0;
        $result = null;
        $this->cycleIterator = null;
        $iterator = $this->getCycleIterator();
        $iterator->rewind();
        if ($iterator->valid()) {
            do {
                $this->getListProperties()->setIndex($iteration);
                $this->updateKeyAndValue($iterator->key(), $iterator->current());
                $result = parent::findChildByClientId($clientId, $recursive);
                if ($result) {
                    break; 
                }
                $iteration++;
                $iterator->next();
            } while ($iterator->valid());
        } else {
            $this->nothingToIterate($iterator);
        }        
        return $result;
    }    
    
    // Lifecycle phases -------------------------------------------------------

    public function processInit()
    {
         // $this->processPhase(Adept_Lifecycle_PhaseId::INIT);
         parent::processInit();
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
    public function processRestoreState()
    {
        parent::processRestoreState();
        //$this->processPhase(Adept_Lifecycle_PhaseId::RESTORE_STATE);
    }    
    
    public function processHandleRequest()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::HANDLE_REQUEST);
    }

    public function processValidation()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::VALIDATION);
    }    
    
    public function processUpdateModel()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::UPDATE_MODEL);
    }

    public function processInvokeApplication()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::INVOKE_APPLICATION);
    }    
    
    public function processSaveState()
    {
        parent::processSaveState();
        //$this->processPhase(Adept_Lifecycle_PhaseId::SAVE_STATE);
    }
    
    public function renderChildren()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::RENDER);
    }
    
    public function renderAjax()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::RENDER_AJAX);
    }

    public function updateKeyAndValue($key, $value) 
    {
        if (!$this->getCycleIterator()->valid()) {
            return ;
        }
        
        $exprContext = $this->getExpressionContext();
        
        if ($this->getValue() != null) {
            $exprContext->set($this->getValue(), $value);
        }
        
        if ($this->getProperties() != null) {
            $exprContext->set($this->getProperties(), $this->getListProperties());
        }
        
        if ($this->getKey() != null) {
            $exprContext->set($this->getKey(), $key);
        }
    }
    
    public function getListSource()
    {
        return $this->getFrom();
    }
    
    // Properties -------------------------------------------------------------
        
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('from');
        $this->addPropertyDescription('key');
        $this->addPropertyDescription('value');
        $this->addPropertyDescription('renderOnly');
        $this->addPropertyDescription('properties');
        $this->addPropertyDescription('selected');
        $this->addPropertyDescription('current');
        $this->addPropertyDescription('currentKey');
        $this->addPropertyDescription('currentValue');
    }
        
    public function getFrom() 
    {
        return $this->getProperty('from', null);
    }

    public function setFrom($from) 
    {
        $this->setProperty('from', $from);
    }

    public function isRenderOnly() 
    {
        return $this->getProperty('renderOnly', false);
    }
    
    public function setRenderOnly($renderOnly) 
    {
        $this->setProperty('renderOnly', $renderOnly);
    }

    public function getValue() 
    {
        return $this->value;
    }

    public function setValue($value) 
    {
        $this->value = $value;
    }

    public function getKey() 
    {
        return $this->key;
    }

    public function setKey($key) 
    {
        $this->key = $key;
    }
    
    public function getProperties()
    {
        return $this->getProperty('properties');
    }
    
    public function setProperties($properties)
    {
        $this->setProperty('properties', $properties);
    }

    public function getCurrent()
    {
        return $this->getProperty('current');
    }
    
    public function setCurrent($current)
    {
        $this->setProperty('current', $current);
    }

    public function getCurrentKey()
    {
        return $this->getProperty('currentKey');
    }
    
    public function setCurrentKey($currentKey)
    {
        $this->setProperty('currentKey', $currentKey);
    }

    public function getCurrentValue()
    {
        return $this->getProperty('currentValue');
    }
    
    public function setCurrentValue($currentValue)
    {
        $this->setProperty('currentValue', $currentValue);
    }
    
    
}
