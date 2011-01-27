<?php

class Adept_Expression_Binding implements Adept_Expression_Evaluable, Adept_Expression_Invokable   
{

    protected $name;
    protected $indexes = array();
    
    /**
     * @var Adept_Expression_Binding
     */
    protected $child = null;

    /**
     * @var Adept_Expression_Binding
     */
    protected $parent = null;
    
    protected function evaluateObject($context)
    {
        if ($this->parent == null) {
            return null;
        }

        $object = $this->parent->evaluateValue($context);
        
        // Return property of $object
        return Adept_ClassKit_Util::getPropertyValue($object, $this->name, $this->indexes);
    }
    
    protected function getContextValue($content)
    {
    	;
    }
    
    protected function setContextValue($content, $value)
    {
        ;
    }
    
    // Evaluable ---------------------------------------------------------------
    
    public function getValue($context)
    {
        if ($this->child != null) {
            return $this->child->getValue($context);
        }
        
        if ($this->parent != null) {
            $this->parent->evaluateValue($context);
        }
        
    }
    
    public function setValue($context, $value)
    {
        if ($this->child != null) {
            $this->child->setValue($context, $value);
            return ;       
        }
    }
    
    public function isReadOnly($context)
    {
    }
    
    // Invokable ---------------------------------------------------------------
    
    public function invoke($context, $args)
    {
    }
    
    // Properties --------------------------------------------------------------
    
    public function getName() 
    {
        return $this->name;
    }
    
    public function setName($name) 
    {
        $this->name = $name;
    }
    
    public function getIndexes() 
    {
        return $this->indexes;
    }
    
    public function setIndexes($indexes) 
    {
        $this->indexes = $indexes;
    }
    
    public function addIndex($index)
    {
    	$this->indexes[] = $index;
    }

    /**
     * @return Adept_Expression_Binding
     */
    public function getChild() 
    {
        return $this->child;
    }
    
    /**
     * @param Adept_Expression_Binding $child
     */
    public function setChild($child) 
    {
        $this->child = $child;
        
        $child->setParent($this);
    }
    
    public function getParent() 
    {
        return $this->parent;
    }
    
    public function setParent($parent) 
    {
        $this->parent = $parent;
    }
    
}

