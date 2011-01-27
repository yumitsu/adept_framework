<?php

class Adept_Component_ColorPicker extends Adept_Component_AbstractInput 
{

    protected function defineProperties()
    {
    	parent::defineProperties();
        $this->addPropertyDescription('buttonClass');
        $this->addPropertyDescription('buttonStyle');
        $this->addPropertyDescription('buttonTitle', array(), '&nbsp;');
        $this->addPropertyDescription('accesskey', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('tabIndex', array(self::CAP_PERSISTENT), null);
    }
    
    public function defineBrowserEvents()
    {
    	return false;
    }   
    
    public function getDefaultRendererType()
    {
    	return 'Adept_Renderer_ColorPicker';
    }
    
    public function hasRenderer()
    {
    	return true;
    }
    
    public function getButtonClass() 
    {
        return $this->getProperty('buttonClass');
    }
    
    public function setButtonClass($buttonClass) 
    {
        $this->setProperty('buttonClass', $buttonClass);
    }
    
    public function getButtonStyle() 
    {
        return $this->getProperty('buttonStyle');
    }
    
    public function setButtonStyle($buttonStyle) 
    {
        $this->setProperty('buttonStyle', $buttonStyle);
    }
    
    public function getButtonTitle() 
    {
        return $this->getProperty('buttonTitle');
    }
    
    public function setButtonTitle($buttonTitle) 
    {
        $this->setProperty('buttonTitle', $buttonTitle);
    }
    
    public function getAccessKey() 
    {
        return $this->getProperty('accesskey');
    }
    
    public function setAccessKey($accesskey)
    {
        $this->setProperty('accesskey', $accesskey);
    }
    
    public function getTabIndex() 
    {
        return $this->getProperty('tabIndex');
    }
    
    public function setTabIndex($tabIndex)
    {
        $this->setProperty('tabIndex', $tabIndex);
    }        
    
}
