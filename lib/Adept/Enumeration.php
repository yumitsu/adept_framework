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

class Adept_Enumeration implements IteratorAggregate, ArrayAccess, Countable  
{

    private static $_constants = null;

    protected function getConstants()
    {
        if (self::$_constants === null) {
            $reflectionClass = new ReflectionClass($this);
            self::$_constants = $reflectionClass->getConstants();        
        }
        return self::$_constants;
    }
    
    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        $arrayObject = new ArrayObject($this->getConstants());
        return $arrayObject->getIterator();
    }
    
    public function get($name)
    {
        $constants = $this->getConstants();
        return $this->has($name) ? $constants[$name] : null;
    }
    
    public function has($name)
    {
        $constants = $this->getConstants();
        return isset($constants[$name]);
    }
    
    public function toArray()
    {
        return $this->getConstants();
    }
    
    // ArrayAccess ------------------------------------------------------------
    
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        throw new Adept_Exception('Unsupported operation');
    }

    public function offsetUnset($offset)
    {
        throw new Adept_Exception('Unsupported operation');
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }    
    
    // Countable --------------------------------------------------------------
    
    public function count()
    {
        return count($this->getConstants());
    }

}
