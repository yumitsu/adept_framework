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

class Adept_ClassKit_Delegate_Static implements Adept_ClassKit_Delegate_Interface 
{
    
    protected $class;
    protected $method;
    protected $file;
    
    public function __construct($class = null, $method = null, $file = null) 
    {
        $this->class = $class;
        $this->method = $method;
        $this->file = $file;
    }
    
    public function invoke($args) 
    {
        if (!class_exists($this->class)) {
            if (!is_null($this->file)) {
                require_once($this->file);
            }
        }
        return call_user_func_array(array($this->class, $this->method), $args);
    }
    
    // Properties -------------------------------------------------------------
    
    public function getClass()
    {
        return $this->class;
    }
    
    public function setClass($class)
    {
        $this->class = $class;
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
