<?php

class Adept_Component_PhaseHandler extends Adept_Component_AbstractBase 
{

    const LOAD_EVENT = 'load';
    
    protected function defineProperties()
    {
        parent::defineProperties();
        
        $this->addPropertyDescription('beforeRestoreState');
        $this->addPropertyDescription('afterRestoreState');
        
        $this->addPropertyDescription('beforeHandleRequest');
        $this->addPropertyDescription('afterHandleRequest');
        
        $this->addPropertyDescription('beforeValidation');
        $this->addPropertyDescription('afterValidation');
        
        $this->addPropertyDescription('beforeUpdateModel');
        $this->addPropertyDescription('afterUpdateModel');
        
        $this->addPropertyDescription('beforeInvokeApplication');
        $this->addPropertyDescription('afterInvokeApplication');
        
        $this->addPropertyDescription('beforeRestoreState');
        $this->addPropertyDescription('afterRestoreState');
        
        $this->addPropertyDescription('beforeRender');
        $this->addPropertyDescription('afterRender');
    }
    
    public function init()
    {
        $this->getRootView()->addPhaseListener(Adept_Lifecycle_PhaseId::ANY, 
            new Adept_ClassKit_Delegate($this, 'onViewPhase'), false);
        
        $this->getRootView()->addPhaseListener(Adept_Lifecycle_PhaseId::ANY, 
            new Adept_ClassKit_Delegate($this, 'onViewPhase'), true);
    }
    
    /**
     * @param Adept_Event_Phase $event
     */
    public function onViewPhase($event)
    {
        // Execute action
        $binding = $this->getMethodBinding($event->getName());
        if ($binding !== null) {
            $binding->invoke($this->getExpressionContext(), array());
        }
        $this->broadcast($event);
    }    
    
    public function hasRenderer()
    {
        return false;
    }
    
    public function getBeforeRestoreState() 
    {
        return $this->getProperty('beforeRestoreState');
    }
    
    public function setBeforeRestoreState($beforeRestoreState) 
    {
        $this->setProperty('beforeRestoreState', $beforeRestoreState);
    }
    
    public function getAfterRestoreState() 
    {
        return $this->getProperty('afterRestoreState');
    }
    
    public function setAfterRestoreState($afterRestoreState) 
    {
        $this->setProperty('afterRestoreState', $afterRestoreState);
    }
    
    public function getBeforeHandleRequest() 
    {
        return $this->getProperty('beforeHandleRequest');
    }
    
    public function setBeforeHandleRequest($beforeHandleRequest) 
    {
        $this->setProperty('beforeHandleRequest', $beforeHandleRequest);
    }
    
    public function getAfterHandleRequest() 
    {
        return $this->getProperty('afterHandleRequest');
    }
    
    public function setAfterHandleRequest($afterHandleRequest) 
    {
        $this->setProperty('afterHandleRequest', $afterHandleRequest);
    }

    public function getBeforeValidation() 
    {
        return $this->getProperty('beforeValidation');
    }
    
    public function setBeforeValidation($beforeValidation) 
    {
        $this->setProperty('beforeValidation', $beforeValidation);
    }

    public function getAfterValidation() 
    {
        return $this->getProperty('afterValidation');
    }
    
    public function setAfterValidation($afterValidation) 
    {
        $this->setProperty('afterValidation', $afterValidation);
    }

    public function getBeforeUpdateModel() 
    {
        return $this->getProperty('beforeUpdateModel');
    }
    
    public function setBeforeUpdateModel($beforeUpdateModel) 
    {
        $this->setProperty('beforeUpdateModel', $beforeUpdateModel);
    }
    
    public function getAfterUpdateModel() 
    {
        return $this->getProperty('afterUpdateModel');
    }
    
    public function setAfterUpdateModel($afterUpdateModel) 
    {
        $this->setProperty('afterUpdateModel', $afterUpdateModel);
    }


    public function getBeforeInvokeApplication() 
    {
        return $this->getProperty('beforeInvokeApplication');
    }
    
    public function setBeforeInvokeApplication($beforeInvokeApplication) 
    {
        $this->setProperty('beforeInvokeApplication', $beforeInvokeApplication);
    }
    
    public function getAfterInvokeApplication() 
    {
        return $this->getProperty('afterInvokeApplication');
    }
    
    public function setAfterInvokeApplication($afterInvokeApplication) 
    {
        $this->setProperty('afterInvokeApplication', $afterInvokeApplication);
    }

    public function getBeforeSaveState() 
    {
        return $this->getProperty('beforeSaveState');
    }
    
    public function setBeforeSaveState($beforeSaveState) 
    {
        $this->setProperty('beforeSaveState', $beforeSaveState);
    }
    
    public function getAfterSaveState() 
    {
        return $this->getProperty('afterSaveState');
    }
    
    public function setAfterSaveState($afterSaveState) 
    {
        $this->setProperty('afterSaveState', $afterSaveState);
    }
    
    public function getBeforeRender() 
    {
        return $this->getProperty('beforeRender');
    }
    
    public function setBeforeRender($beforeRender) 
    {
        $this->setProperty('beforeRender', $beforeRender);
    }

    public function getAfterRender() 
    {
        return $this->getProperty('afterRender');
    }
    
    public function setAfterRender($afterRender) 
    {
        $this->setProperty('afterRender', $afterRender);
    }
    
}
