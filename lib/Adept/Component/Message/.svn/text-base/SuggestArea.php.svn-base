<?php

class Adept_Component_Message_SuggestArea extends Adept_Component_AbstractBase implements Adept_Component_DomContainer  
{
    const SUGGEST_EVENT = 'suggest';
    protected function defineProperties()
    {
        parent::defineProperties();
        
        $this->addPropertyDescription('for');
        $this->addPropertyDescription('cssClass');
        $this->addPropertyDescription('cssStyle');
        $this->addPropertyDescription('positioned');
        $this->addPropertyDescription('delay');
        $this->addPropertyDescription('minSize');
        $this->addPropertyDescription('hidden',array(), true);
        $this->addPropertyDescription('selectedClass',array(), 'suggest-selected');   
        $this->addPropertyDescription('url');
        $this->addPropertyDescription('partition');
       
        
    }
    
    public function getDomContainerId()
    {
        return $this->getClientId();
    }
    
    
    public function hasRenderer()
    {
    	return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Message_SuggestArea';
    }
    
    
    // Properties---------------------------------------------------------------
    
    
    public function getFor() 
    {
       return $this->getProperty('for');
    }
    
    public function setFor($for) 
    {
       $this->setProperty('for', $for);
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
    
    public function isPositioned() 
    {
       return $this->getProperty('positioned');
    }
    
    public function setPositioned($positioned) 
    {
       $this->setProperty('positioned', $positioned);
    }
    
    
    public function getDelay() 
    {
       return $this->getProperty('delay');
    }
    
    public function setDelay($delay) 
    {
       $this->setProperty('delay', $delay);
    }
    
    public function getMinSize() 
    {
       return $this->getProperty('minSize');
    }
    
    public function setMinSize($minSize) 
    {
       $this->setProperty('minSize', $minSize);
    }
    
    
    public function isHidden() 
    {
       return $this->getProperty('hidden');
    }
    
    public function setHidden($hidden) 
    {
       $this->setProperty('hidden', $hidden);
    }
    
    public function getSelectedClass() 
    {
       return $this->getProperty('selectedClass');
    }
    
    public function setSelectedClass($selectedClass) 
    {
       $this->setProperty('selectedClass', $selectedClass);
    }
    
    public function getPartition() 
    {
       return $this->getProperty('partition');
    }
    
    public function setPartition($partition) 
    {
       $this->setProperty('partition', $partition);
    }
    
    
    public function getUrl() 
    {
       return $this->getProperty('url');
    }
    
    public function setUrl($url) 
    {
       $this->setProperty('url', $url);
    }
    
    
    
}



