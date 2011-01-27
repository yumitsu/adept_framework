<?php

class Adept_Renderer_Google_Map extends Adept_Renderer_AbstractControl

{
    
        
    /**
     * @param Adept_Component_Google_Map $component
     */
    
    public function handleRequest($component)
    {
       $request = Adept_Context::getInstance()->getRequest();
       
       if ($request->has($component->getClientId() . "_data")){
           $component->fillParameters(Adept_Json::decode($request->get($component->getClientId() . "_data")));
           $component->setSinchronize(true); 
       } 
    }
    
    /**
     * @param Adept_Component_Map_Google $component
     */
    
    public function renderAjax($component)
    {
        
        Adept_Context::getInstance()->getAjaxChannel()
            ->googleSynchronize($component->getClientId(), Adept_Json::encode($component->toArray()));
    }
    
    
    /**
     * @param Adept_Component_Map_Google $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        
        $writer->writeTag('div', array('id' => $component->getClientId(),
                                        'style' => "width:{$component->getWidth()}px;height:{$component->getHeight()}px;",
                                        ));
        
    }
    
    
        
    /**
     * @param Adept_Component_Map_Google $component
     */
    public function renderChildren($component)
    {
           
    }
    
        
    /**
     * @param Adept_Component_Map_Google $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeClosedTag('div');
        $writer->writeScriptBegin();
        $writer->writeHtml('Adept.Observer.addListener(window, "load", function() {');
        $this->renderClientController($component->getClientId(),"Adept.Controller.Google.Map",
                                        array((double) $component->getLatitude(),(double) $component->getLongitude(),(int) $component->getZoom()),
                                        array('typeControl' => $component->isTypeControl(), 
                                            'mapControl' => $component->getMapControl(),
                                            'draggable' => $component->isDraggable(),
                                            'type' => Adept_Verbatim::create($component->getType()),
                                            'scrollingZoom' => $component->isScrollingZoom(),
                                        
                                        
                                        
                                        
                                        ));
        $writer->writeHtml('});');
        $writer->writeScriptEnd();
        
        foreach ($component->getMarkers() as $marker){
            $marker->render();
        }
        
     }
    
    /**
     * @param Adept_Component_Map_Google $component
     */
    public function getRequiredJs($component)
    {
        return array('Adept/Controller.js', 'Adept/Controller/Google/Map.js');
    }
    
     
}

