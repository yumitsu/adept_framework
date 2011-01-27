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

class Adept_Template_AttributeInfo 
{

    protected $name;
    protected $type;
    protected $required;
    protected $property;
    
    public function __construct($name, $type = 'string', $required = false, $property = null)
    {
        $this->setName($name);
        $this->setType($type);
        $this->setRequired($required);
        
        if ($property !== null) {
            $this->setProperty($property);
        } else {
            $this->setProperty($name);
        }
    }
    
    public function getName() 
    {
        return $this->name;
    }
    
    public function setName($name) 
    {
        $this->name = $name;
    }
    
    public function getType() 
    {
        return $this->type;
    }
    
    public function setType($type) 
    {
        $this->type = strtolower($type);
    }
    
    public function isRequired() 
    {
        return $this->required;
    }
    
    public function setRequired($required) 
    {
        $this->required = $required;
    }
    
    public function isBoolean()
    {
        return $this->getType() == 'bool' || $this->getType() == 'boolean';
    }
    
    public function getProperty() 
    {
        return $this->property;
    }
    
    public function setProperty($property) 
    {
        $this->property = $property;
    }
    
}