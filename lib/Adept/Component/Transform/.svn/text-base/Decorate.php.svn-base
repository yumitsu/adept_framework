<?php

class Adept_Component_Transform_Decorate extends Adept_Component_Transform_Include   
{
    
    protected $parameters = array();
    protected $defines = array();
    
    protected function applyDefinitions()
    {
    	$defines = $this->findChildrenByClass('Adept_Component_Transform_Define', false);
    	foreach ($defines as $define) {
    	    $this->defines[strtolower($define->getName())] = $define;
    	}
    }

    public function findDefinition($name)
    {
        $name = strtolower($name);
        return isset($this->defines[$name]) ? $this->defines[$name] : null;
    }
    
    public function removeDefinitions()
    {
        foreach ($this->defines as $define) {
        	$index = $this->getChildren()->indexOf($define);
        	if ($index !== false) {
                $this->getChildren()->remove($index);
        	}
        }
    }
        
    public function processInit()
    {
        $this->applyDefinitions();
        parent::processInit();
        $this->removeDefinitions();
    }
    
    protected function getParameters()
    {
        return $this->findChildByClass('Adept_Component_Transform_Parameter', false);
    }
       
    public function hasRenderer()
    {
        return false;
    }
    
    // Properties --------------------------------------------------------------
    
    public function getFile() 
    {
        return $this->getProperty('file');
    }
    
    public function setFile($file) 
    {
        $this->setProperty('file', $file);
    }
        
    
}

