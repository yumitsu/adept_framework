<?php

/**
 * Adept Framework
 *
 * LICENSE
 *
 * This source file is subject to the BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://adept-project.com/license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@adept-project.com so we can send you a copy immediately.
 *
 * @category   Adept
 * @package    Adept_Template
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Template_TagInfo {
    
    protected $name;
    
    /**
     * @var Adept_CanonicalMap
     */
    protected $attributes = array();
    
    /**
     * @var Adept_CanonicalMap
     */
    protected $parameters = array();
    
    protected $class;
    
    protected $closed = false;
    
    protected $bodyContent = 'ML';
    
    protected $dynamicAttributes;

    public function __construct()
    {
        $this->attributes = new Adept_CanonicalMap();
        $this->parameters = new Adept_CanonicalMap();
    }

    public function getName() 
    {
        return $this->name;
    }
    
    public function setName($name) 
    {
        $this->name = $name;
    }
    
    public function hasAttribute($name)
    {
        return $this->attributes->has($name);
    }
    
    /**
     * @return Adept_CanonicalMap
     */
    public function getAttributes() 
    {
        return $this->attributes;
    }
    
    public function addAttribute($name, $value)
    {
        $this->attributes->set($name, $value);
    }
    
    public function addAttributes($attributes) 
    {
        foreach ($attributes as $name => $value) {
            $this->addAttribute($name, $value);
        }
    }
    
    public function getBodyContent() 
    {
        return $this->bodyContent;
    }
    
    public function setBodyContent($bodyContent) 
    {
        $this->bodyContent = $bodyContent;
    }

    public function getClass() 
    {
        return $this->class;
    }
    
    public function setClass($class) 
    {
        $this->class = $class;
    }
    
    public function isClosed() 
    {
        return $this->isBodyEmpty(); 
    }
    
    public function isBodyEmpty()
    {
    	return strcasecmp($this->getBodyContent(), 'empty') === 0;
    }
    
    public function isBodyLiteral()
    {
        return strcasecmp($this->getBodyContent(), 'cdata') === 0;
    }
    
    public function isDynamicAttributes()
    {
        return $this->dynamicAttributes;
    }
    
    public function setDynamicAttributes($dynamicAttributes)
    {
        $this->dynamicAttributes = $dynamicAttributes;
    }
    
    public function getParameter($name, $default = null) 
    {
        return $this->parameters->has($name) ? $this->parameters->get($name) : $default;
    }
    
    public function addParameter($name, $parameter) 
    {
        $this->parameters->set($name, $parameter);
    }
    
    /**
     * @return Adept_CanonicalMap
     */
    public function getParameters() 
    {
        return $this->parameters;
    }
    
    public function addParameters($parameters) 
    {
        foreach ($parameters as $name => $parameter) {
            $this->addParameter($name, $parameter);
        }
    }
    
}
