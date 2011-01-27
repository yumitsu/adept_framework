<?php

class Adept_Session_Namespace extends Adept_Session_Abstract  
{
    
    /**
     * @var Adept_Session_Abstract
     */
    private $_session;
    
    /**
     * @var string
     */
    private $_namespace;

    /**
     * Constructor.
     * 
     * @param Adept_Session_Abstract $session
     * @param string $name
     */
    public function __construct($session, $namespace)
    {
    	$this->_session = $session;
    	$this->_namespace = $namespace;
    }
    
    public function getNamespacePrefix()
    {
        return $this->_namespace;
    }
    
    protected function _resolveName($localName)
    {
    	return $this->_namespace . '::' . $localName;
    }
    
    public function get($name)
    {
    	return $this->_session->get($this->_resolveName($name));
    }
    
    public function set($name, $value)
    {
    	return $this->_session->set($this->_resolveName($name), $value);
    }
    
    public function has($name)
    {
    	return $this->_session->has($this->_resolveName($name));
    }

    public function remove($name)
    {
    	return $this->_session->remove($this->_resolveName($name));
    }
    
}