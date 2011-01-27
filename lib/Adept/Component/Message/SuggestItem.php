<?php

class Adept_Component_Message_SuggestItem extends Adept_Component_AbstractBase 
{
    
    protected function defineProperties()
    {
        parent::defineProperties();
        
        $this->addPropertyDescription('suggest');
        $this->addPropertyDescription('cssClass');
        $this->addPropertyDescription('cssStyle');
        
    }
    
    public function hasRenderer()
    {
        return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Message_SuggestItem';
    }
    
    
    // Properties---------------------------------------------------------------
    
    
    
    public function getSuggest() 
    {
       return $this->getProperty('suggest');
    }
    
    public function setSuggest($suggest) 
    {
       $this->setProperty('suggest', $suggest);
    }
    
    public function getCssClass() 
    {
       return $this->getProperty('cssClass');
    }
    
    public function setCssClass($cssClass) 
    {
       $this->setProperty('cssClass', $cssClass);
    }
    
    public function getCssStyle() 
    {
       return $this->getProperty('cssStyle');
    }
    
    public function setCssStyle($cssStyle) 
    {
       $this->setProperty('cssStyle', $cssStyle);
    }
    
}

