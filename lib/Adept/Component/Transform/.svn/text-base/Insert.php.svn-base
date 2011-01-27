<?php

class Adept_Component_Transform_Insert extends Adept_Component_AbstractBase 
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

    public function init()
    {
    	$view = $this->findParentByClass('Adept_Component_Transform_Decorate');
    	if ($view) {
            $define = $view->findDefinition($this->getName());
            if ($define) {
                $this->transformToDefine($define);
                return ;                 
            }
    	}
    	$this->transformToDefault();
    }
    
    protected function replaceWith($children)
    {
        $index = $this->getParent()->getChildren()->indexOf($this);
        $this->getParent()->getChildren()->remove($index);
        
        $this->getParent()->getChildren()->insertAll($index, $children);
        foreach ($children as $child) {
        	$child->setParent($this->getParent());
        }
    }
    
    public function transformToDefault()
    {
        $this->replaceWith($this->getChildren());
    }
    
    /**
     * @param Adept_Component_Transform_Define $define
     */
    public function transformToDefine($define)
    {
    	$this->replaceWith($define->getChildren());
    }
    
    // Properties --------------------------------------------------------------
    
    public function getName() 
    {
        return $this->getProperty('name');
    }
    
    public function setName($name) 
    {
        $this->setProperty('name', $name);
    }
        
}