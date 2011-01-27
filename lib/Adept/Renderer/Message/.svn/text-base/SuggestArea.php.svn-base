<?php

class Adept_Renderer_Message_SuggestArea extends Adept_Renderer_AbstractControl  
{
    
    protected $listeners = array();
    
    /**
     * @param Adept_Component_Message_SuggestArea $component
     */
    public function handleRequest($component)
    {
    	$request = Adept_Context::getInstance()->getRequest();
        $response = Adept_Context::getInstance()->getResponse();
        if ($request->has('event')) {
            $event = $request->get('event');
            if (isset($event[$component->getClientId()]) && 
                $event[$component->getClientId()] == Adept_Component_Message_SuggestArea::SUGGEST_EVENT) {
                $component->markDirty(Adept_Component_DirtyState::CHILDREN);
            }
        }
    }
    
    /**
     * @param Adept_Component_Message_SuggestArea $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
       
        $writer->writeTag('div', array(
            'id' => $component->getClientId(),
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle() != null ? $component->getCssStyle() : 'display:none',
        ));
    }
    
    /**
     * @param Adept_Component_Message_SuggestArea $component
     */
    public function renderChildren($component)
    {
        
        if ($this->getRequest()->isAjax()){
            foreach ($component->getChildren() as $child){
                if (!($child instanceof Adept_Component_Client_Listener)){
                    $child->render();
                }
            }
        }
        
            foreach ($component->getChildren() as $child){
                if ($child instanceof Adept_Component_Client_Listener){
                 $this->listeners[] = $child;   
                }
            }
        
        
    }
    
    /**
     * @param Adept_Component_Message_SuggestArea $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeClosedTag('div');
        $writer->writeScriptBegin();
        $this->renderClientController($component->getClientId(), 
            'Adept.Controller.Message.SuggestArea', array($component->getFor(), $component->isPositioned()),
            array(
                'hidden' => (bool)$component->isHidden(),
                'minSize' => (int) $component->getMinSize(),
                'delay' => (int)$component->getDelay(),
                'selectedClass' => $component->getSelectedClass(),
                'url' => $component->getUrl(),
                'partition' => $component->getPartition()
                
            ));
        $writer->writeScriptEnd();
        foreach ($this->listeners as $listener){
            $listener->render();
        }
    }
    
    public function getRequiredJs()
    {
    	return array('Adept/Controller.js', 'Adept/Controller/Message/SuggestArea.js');
    }
    
}

