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
 * @package    Adept_ClassKit
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_ClassKit_Delegate implements Adept_ClassKit_Delegate_Interface 
{
    
    protected $object;
    protected $method;

    /**
     * Constructor
     *
     * @param mixed $object Delegate destination object
     * @param string $method Method of object
     */
    public function __construct($object = null, $method = null) 
    {
        if ($object != null) {
            $this->setObject($object);
        }
        if ($method != null) {
            $this->setMethod($method);
        }
    }

    /**
     * Invoke delegated method 
     *
     * @param array $args
     * @return mixed 
     */
    public function invoke($args) 
    {        
        return call_user_func_array(array($this->object, $this->method), $args);
    }
    
    // Properties -------------------------------------------------------------
    
    public function getObject() 
    {
        return $this->object;
    }
    
    public function setObject($object) 
    {
        if (!is_object($object)) {
            throw new Adept_Exception_IllegalArgument('$object is not a object');
        }
        $this->object = $object;
    }
    
    public function getMethod() 
    {
        return $this->method;
    }
    
    public function setMethod($method) 
    {
        $this->method = $method;
    }
    
}