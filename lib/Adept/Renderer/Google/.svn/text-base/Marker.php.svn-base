<?php

class Adept_Renderer_Google_Marker extends Adept_Renderer_AbstractControl
{
        
    /**
     * @param Adept_Component_Map_GoogleMarker $component
     */
    
    public function handleRequest($component)
    {
        
        
    }
    
    /**
     * @param Adept_Component_Google_Marker $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        $writer->writeScriptBegin();
        $options = array();
        $options['latitude'] = $component->getLatitude();
        $options['longitude'] = $component->getLongitude();
        $options['draggable'] = $component->isDraggable();
        $options['removable'] = $component->isRemovable();
        if($component->getIcon()) {
            $options['iconImage'] = $component->getIcon();
            $options['transparentImage'] =  $component->getTransparentIcon();
        }
        $windowContent = $component->getWindowContent();
        
        if($windowContent != '') {
            $options['windowContent'] = $windowContent;
        }
        $writer->writeHtml('Adept.Observer.addListener(window, "load", function() {');
        $this->renderClientController(
            $component->getClientId(), 'Adept.Controller.Google.Marker',
                array(Adept_Verbatim::create("Adept.Application.getController('{$component->getParent()->getClientId()}')"),
                new Adept_Map($options)) 
            );
        $writer->writeHtml('});');
        $writer->writeScriptEnd();
        
    }
    
    
        
    /**
     * @param Adept_Component_Map_GoogleMarker $component
     */
    public function renderChildren($component)
    {
        
    }
    
    public function getRequiredJs($component)
    {
        return array('Adept/Controller.js', 'Adept/Controller/Google/Marker.js');
    }
    
    
        
    
     
}

