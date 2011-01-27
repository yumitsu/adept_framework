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

abstract class Adept_Access implements ArrayAccess
{
    
    // Abstract methods --------------------------------------------------------
    
    public function get($name)
    { }
    
    public function set($name, $value)
    { }
    
    public function has($name)
    { }
    
    public function remove($name)
    { }
    
    public function merge($arrayOrCollection)
    {
        foreach ($arrayOrCollection as $key => $value) {
            $this->set($key, $value);
        }
    }
    
    // Magic methods -----------------------------------------------------------

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __isset($name)
    {
        return $this->has($name);
    }

    public function __unset($name)
    {
        return $this->remove($name);
    }

    // ArrayAccess -------------------------------------------------------------
    
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        if (!isset($offset)) {
            $this->set(null, $value);
        } else {
            $this->set($offset, $value);
        }
    }

    public function offsetUnset($offset)
    {
        return $this->remove($offset);
    }
    
}
