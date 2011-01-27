<?php

class Adept_DataObject extends Adept_Object  
{
    
    private $_data = array();

    public function __construct($data = array())
    {
        $this->_data = $data;
    }
    
    /**
     * Initialize object data.
     *
     * @param array $data
     */
    public function fromArray(array $data)
    {
        $this->_data = $data;
    }
    
    /**
     * Returns object data.
     * 
     * @return array
     */
    public function toArray()
    {
        return $this->_data;
    }
    
    public function get($name)
    {
        return isset($this->_data[$name]) ? $this->_data[$name] : null;
    }
    
    public function set($name, $value)
    { 
        $this->_data[$name] = $value;
    }
    
    /**
     * Mock get- or set- method. 
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if (substr($method, 0, 3) == 'get') {
            $name = lcfirst(substr($method, 3));
            return $this->get($name);
        } elseif (substr($method, 0, 2) == 'is') {
            $name = lcfirst(substr($method, 2));
            return $this->get($name);
        } elseif (substr($method, 0, 3) == 'set') {
            $name = lcfirst(substr($method, 3));
            $this->set($name, $arguments[0]);
        } else {
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (method_exists($this, 'get' . ucfirst($name))) {
            return call_user_func(array($this, 'get' . ucfirst($name)));
        } elseif (method_exists($this, 'is' . ucfirst($name))) {
            return call_user_func(array($this, 'is' . ucfirst($name)));
        } else {
            return isset($this->_data[$name]) ? $this->_data[$name] : null;
        }
    }    
    
    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if (method_exists($this, 'set' . ucfirst($name))) {
            call_user_func(array($this, 'set' . ucfirst($name)), $value);
        } else {
            $this->set($name, $value);
        }
    }    
    
}

if(!function_exists('lcfirst')){
    function lcfirst($str)
    {
        $firstLettesr = substr($str, 0, 1);
        $firstLettesr = strtolower($firstLettesr);
        return $firstLettesr . substr($str, 1);    
    }
}
