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

class Adept_Component_Set extends Adept_Component_AbstractBase 
{
    protected $renderOnly;
    
    protected $binding = null;
    
    protected function handlePhase($phaseId)
    {
        if (($phaseId != Adept_Lifecycle_PhaseId::RENDER && $phaseId != Adept_Lifecycle_PhaseId::RENDER_AJAX) 
            && $this->isRenderOnly()) {
                return ;
        }
        $this->doSet();
    }
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('binding');
        $this->addPropertyDescription('name');
        $this->addPropertyDescription('value');
        $this->addPropertyDescription('global', array(), false);        
        $this->addPropertyDescription('renderOnly', array(), false);
    }
    
//    public function processInit()
//    {
//         $this->handlePhase(Adept_Lifecycle_PhaseId::INIT);
//    } 
    
    public function processHandleRequest()
    {
        $this->handlePhase(Adept_Lifecycle_PhaseId::HANDLE_REQUEST);
    }    
    
    public function renderChildren()
    {
        $this->handlePhase(Adept_Lifecycle_PhaseId::RENDER);
    } 
    
    public function renderAjax()
    {
    	$this->handlePhase(Adept_Lifecycle_PhaseId::RENDER_AJAX);
    }
    
    public function processRestoreState()
    {
       //$this->handlePhase(Adept_Lifecycle_PhaseId::RESTORE_STATE);
    }
    
    public function processValidation()
    {
        $this->handlePhase(Adept_Lifecycle_PhaseId::VALIDATION);
    }
    
    public function processUpdateModel()
    {
        $this->handlePhase(Adept_Lifecycle_PhaseId::UPDATE_MODEL);
    }
    
    public function processInvokeApplication()    
    {
        $this->handlePhase(Adept_Lifecycle_PhaseId::INVOKE_APPLICATION);
    }
    
    public function processSaveState()
    {
        // $this->handlePhase(Adept_Lifecycle_PhaseId::SAVE_STATE);
    }
    
    public function doSet() 
    {
        // Check scope and define context
        if ($this->isGlobal()) {
            $context = Adept_Context::getInstance();
        } else {
            $context = $this->getExpressionContext();
        }
        
        $binding = $this->getValueBinding('binding');
        if ($binding) {
            $binding->setValue($context, $this->getValue());
        } else {
            $context->set($this->getName(), $this->getValue());
        }
    }    

    public function isRenderOnly() 
    {
        return $this->getProperty('renderOnly');
    }
    
    public function setRenderOnly($renderOnly)
    {
        $this->setProperty('renderOnly', $renderOnly);
    }
    
    public function getBinding() 
    {
        return $this->getProperty('binding');
    }
    
    public function setBinding($binding)
    {
        $this->setProperty('binding', $binding);
    }    
    
    public function getName() 
    {
        return $this->getProperty('name');
    }
    
    public function setName($name)
    {
        $this->setProperty('name', $name);
    }
    
    public function getValue() 
    {
        return $this->getProperty('value');
    }
    
    public function setValue($value)
    {
        $this->setProperty('value', $value);
    }
    
    public function isGlobal() 
    {
        return $this->getProperty('global');
    }
    
    public function setGlobal($global)
    {
        $this->setProperty('global', $global);
    }    
    
    public function hasRenderer()
    {
        return false;
    }
    
}
