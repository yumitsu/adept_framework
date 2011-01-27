<?php

class Adept_Component_RichEdit extends Adept_Component_AbstractInput 
{

    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('width', array());
    	$this->addPropertyDescription('height', array(), 400);
    	$this->addPropertyDescription('mode');
    	$this->addPropertyDescription('basePath');
        $this->addPropertyDescription('configPath');	
    }
    
    public function defineBrowserEvents()
    {
    	return array();
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_RichEdit';
    }

    public function hasRenderer() 
    {
        return true;
    }
    
    public function getHeight() 
    {
        return $this->getProperty('height');
    }
    
    public function setHeight($height) 
    {
        $this->setProperty('height', $height);
    }

    public function getWidth() 
    {
        return $this->getProperty('width');
    }
    
    public function setWidth($width) 
    {
        $this->setProperty('width', $width);
    }
    
    public function getMode() 
    {
        return $this->getProperty('mode');
    }
    
    public function setMode($mode) 
    {
        $this->setProperty('mode', $mode);
    }

    public function getBasePath() 
    {
        return $this->getProperty('basePath');
    }
    
    public function setBasePath($basePath) 
    {
        $this->setProperty('basePath', $basePath);
    }

    public function getConfigPath() 
    {
        return $this->getProperty('configPath');
    }
    
    public function setConfigPath($configPath) 
    {
        $this->setProperty('configPath', $configPath);
    }
    
}