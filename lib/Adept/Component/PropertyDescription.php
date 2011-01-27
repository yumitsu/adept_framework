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
 * @package    Adept_Component
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

final class Adept_Component_PropertyDescription implements Adept_Component_PropertyTypesAndCaps
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $capabilities;

    /**
     * Default property value.
     * 
     * @var mixed
     */
    protected $default;

    /**
     * Constructor.
     *
     * @param string $name Property name
     * @param string $type Property type
     * @param array $capabilities Capability flags.
     * @param mixed $default 
     */
    public function __construct($name, $capabilities = array(), $default = null, $type = self::TYPE_MIXED)
    {
        if (empty($name)) {
            throw new Adept_Exception_IllegalArgument('$name cannot be empty');
        }
        if ($capabilities === null) {
            $capabilities = array();
        }
        
        if (!is_array($capabilities)) {
            throw new Adept_Exception_IllegalArgument('$capabilities must be an array');
        }
        
        if (in_array(self::CAP_CLIENT, $capabilities) && in_array(self::CAP_PERSISTENT, $capabilities)) {
            throw new Adept_Exception('Cannot use CAP_CLIENT and CAP_PERSISTENT together.');
        }
        
        $this->name = $name;
        $this->type = $type;
        $this->capabilities = $capabilities;
        $this->default = $default;
    }

    // Properties --------------------------------------------------------------
        public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns capabilities array.
     *
     * @return array.
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * Returns default property value.
     *
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }
    
    public function setDefault($value)
    {
        $this->default = $value;
    }    

    public function isPersistent()
    {
        return in_array(self::CAP_PERSISTENT, $this->capabilities);
    }

    public function isClient()
    {
        return in_array(self::CAP_CLIENT, $this->capabilities);
    }

    public function isNotBound()
    {
        return in_array(self::CAP_NOT_BOUND, $this->capabilities);
    }

    public function isString()
    {
        return $this->type == self::TYPE_STRING;
    }

    public function isInt()
    {
        return $this->type == self::TYPE_INT;
    }

    public function isFloat()
    {
        return $this->type == self::TYPE_FLOAT;
    }

    public function isArray()
    {
        return $this->type == self::TYPE_ARRAY;
    }
    
    public function isResource()
    {
        return $this->type == self::TYPE_RESOURCE;
    }

    public function isObject()
    {
        return !in_array($this->type, array(
            self::TYPE_MIXED,
            self::TYPE_RESOURCE,
            self::TYPE_ARRAY, 
            self::TYPE_BOOL, 
            self::TYPE_FLOAT, 
            self::TYPE_INT, 
            self::TYPE_STRING));
    }
}
