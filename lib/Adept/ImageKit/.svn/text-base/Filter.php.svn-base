<?php

abstract class Adept_ImageKit_Filter
{
    protected $params = array();
    
    public function __construct($parameters = array())
    {
    	if (count($parameters) > 0){
    	    $this->setParams($parameters);
    	}
    }
    
    abstract public function apply($container);
    
    public function setParams($params)
    {
    	foreach ($params as $key => $value){
    	    $this->set($key, $value);
    	}
    }
    
    
    public function get($name, $default = null)
    {
    	return  isset($this->params[$name])? $this->params[$name]: $default;
    }
    
    public function set($name, $value)
    {
    	$this->params[$name] = $value;
    }
    
    
}

