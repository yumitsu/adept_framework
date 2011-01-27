<?php

class Adept_Component_PropertiesRegistry 
{
    
    const CONTEXT_KEY = '_propertiesRegistry';
    
    protected $classes = array();
    
    protected function __construct()
    { }

    /**
     * @return Adept_Component_PropertiesRegistry
     */
    public function getInstance()
    {
        $instance = Adept_Context::getInstance()->get(self::CONTEXT_KEY);
        if (!$instance) {
            $instance = new self();
            Adept_Context::getInstance()->set(self::CONTEXT_KEY, $instance);
        }
        return $instance;
    }
    
    /** 
     * @param string $class
     * @param string $name
     * @param array $capabilities
     * @param mixed $default
     * @param string $type
     * @return Adept_Component_PropertyDescription
     */
    public function addPropertyDescription($class, $name,  
        $capabilities = array(), $default = null, $type = self::TYPE_MIXED)
    {    
        if (!isset($this->classes[$class])) {
            $this->classes[$class] = new Adept_CanonicalMap();
        }
        $description = new Adept_Component_PropertyDescription($name, $capabilities, $default, $type);
        $this->classes[$class]->set($name, $description);
        return $description;
    }
    
    /**
     * @param string $class
     * @return Adept_Map
     */
    public function getProperyDecriptions($class)
    {
        return isset($this->classes[$class]) ? $this->classes[$class] : null;
    }
    
    /**
     * Returns property definition structure.
     *
     * @param string $property Class name.
     * @param string $property Property name.
     * @return Adept_Component_PropertyDescription
     */
    public function getPropertyDescription($class, $property)
    {
        $pds = $this->getProperyDecriptions($class); 
        if ($pds == null) {
            return null;
        }
        return $pds->get($property);
    }
    
    public function isClassExists($class)
    {
        return isset($this->classes[$class]);
    }
    
}

