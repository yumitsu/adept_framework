<?php

class Adept_Component_Transform_Define extends Adept_Component_AbstractBase 
{

    protected function defineProperties()
    {
    	parent::defineProperties();
    	$this->addPropertyDescription('name');
    }

    public function hasRenderer()
    {
        return false;
    }
    
    public function getName() 
    {
        return $this->getProperty('name');
    }
    
    public function setName($name) 
    {
        $this->setProperty('name', $name);
    }
    
}

