<?php

class Adept_Component_ViewHandler extends Adept_Component_AbstractBase 
{

    const LOAD_EVENT = 'load';
    
    protected function defineProperties()
    {
        parent::defineProperties();
        
        $this->addPropertyDescription('load');
    }
    
    public function init()
    {
        
        $this->getRootView()->addPhaseListener(Adept_Lifecycle_PhaseId::HANDLE_REQUEST, 
            new Adept_ClassKit_Delegate($this, 'onHandleRequest'), true);
    }
    
    /**
     * @param Adept_Event_Phase $event
     */
    public function onHandleRequest($event)
    {
        if (!$this->getRootView()->isAlreadyLoaded()) {
            
            $loadAction = $this->getLoad();
            if ($loadAction) {
                $loadAction->invoke($this->getExpressionContext(), array());
            }
        }
    }    
    
    public function hasRenderer()
    {
        return false;
    }
    
    // Load event ---------------------------------------------------------------
    
    /**
     * Add init event listener.
     *
     * @param mixed $listener
     */
    public function addLoadListener($listener)
    {
        $this->addEventListener(self::LOAD_EVENT, $listener);
    }
    
    // Properties --------------------------------------------------------------
    
    /**
     * @return Adept_Expression_Invokable
     */
    public function getLoad() 
    {
        return $this->getMethodBinding('load');
    }
    
    public function setLoad($load) 
    {
        $this->setProperty('load', $load);
    }

}
