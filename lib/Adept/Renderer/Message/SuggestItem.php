<?php


class Adept_Renderer_Message_SuggestItem extends Adept_Renderer_Base 
{
    
    /**
     * @param Adept_Component_Message_SuggestItem $component
     */
    public function renderBegin($component)
    {

        $writer = $this->getWriter();
        $writer->writeTag('div', array(
            'id' => $component->getClientId(),
            'style' => $component->getCssStyle(),
            'class' => '_suggest-item ' . $component->getCssClass(),
            'suggest' => $component->getSuggest()     
        ));
        
    }


    /**
     * @param Adept_Component_Message_SuggestItem $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeClosedTag('div');
        
    }
    
    
}

