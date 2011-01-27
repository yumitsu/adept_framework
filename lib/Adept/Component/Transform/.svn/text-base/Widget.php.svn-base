<?php

class Adept_Component_Transform_Widget extends Adept_Component_SubView  
{
    
    protected $parameters = array();
    protected $defines = array();
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('file');
    }
    
    protected function includeTemplate()
    {
        try {
            $subView = Adept_ViewLoader::getInstance()->loadTemplate($this->getFile());
        } catch (Adept_Template_Exception $e) {
            throw new Adept_Component_Exception($e);
        }
        
        foreach ($subView->getChildren() as $child) {
            $this->addChild($child);
        }
    }
    
    protected function setUpDefinitions()
    {
    	$defines = $this->findChildrenByClass('Adept_Component_Transform_Define', false);
    	
    	foreach ($defines as $define) {
    	    $this->defines[strtolower($define->getName())] = $define;
    	}
    }
    
    public function findDefine($name)
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
        $this->includeTemplate();
        // $this->setupParameters();
        $this->setUpDefinitions();
        parent::processInit();
        $this->removeDefinitions();
    }
    
//    public function setupParameters()
//    {
//        foreach ($this->getParameters() as $param) {
//            $this->getExpressionContext()->set($param->getName(), $param->getValue());
//        }
//    }
    
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

