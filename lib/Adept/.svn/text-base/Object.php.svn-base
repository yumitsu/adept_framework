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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

/**
 * Base object
 * 
 * 1. Supports property access via __get / __set methods. 
 * 
 * E.g.
 *   $var = $foo->bar; // runs $foo->getBar() method.
 *   $foo->bar = 'value'; // runs $foo->setBar('value') method.  
 */
class Adept_Object 
{

    /**
     * Basic toString method
     *
     * @return string
     */
    public function __toString()
    {
    	return 'Object of ' . get_class($this) . ' class';
    }
    
    // Magic property access ---------------------------------------------------
    
    /**
     * Calls get/is method and return result.
     * 
     * @param  string $name propery name
     * @return mixed
     * 
     * @throws Adept_Exception if getter not found.
     */
    public function __get($name)
    {
    	if (method_exists($this, 'get' . ucfirst($name))) {
    	    return call_user_func(array($this, 'get' . ucfirst($name)));
    	} elseif (method_exists($this, 'is' . ucfirst($name))) {
    	    return call_user_func(array($this, 'is' . ucfirst($name)));
    	} else {
    	    throw new Adept_Exception("Cannot get property '{$name}', property or getter not found.");
    	}
    }
    
    /**
     * Calls set method.
     * 
     * @param  string $name  property name
     * @param  mixed  $value property value
     * @return void
     * 
     * @throws Adept_Exception if setter not found.
     */   
    public function __set($name, $value)
    {
    	if (method_exists($this, 'set' . ucfirst($name))) {
    	    call_user_func(array($this, 'set' . ucfirst($name)), $value);
    	} else {
    	    throw new Adept_Exception("Cannot set property '{$name}', property or setter not found. ");
    	}
    }
    
}
