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

class Adept_ClassKit_Util
{

    /**
     * Creates object of specified class and pass $parameters to constructor.
     * <code>
     * $object = Adept_ClassKit_Util::createObject('FooClass', array(10, 'bar'));
     * </code>
     * 
     * @param string $class Class name
     * @param array $parameters Constructor parameters
     * @return mixed Instance of $class 
     * @throws Adept_Exception If $class not exists and cannot be autoloaded
     */
    public static function createObject($class, $parameters = array())
    {
        if (count($parameters) == 0) {
            return new $class();
        } else {
            if (class_exists($class)) {
                $code = '$obj = new ' . $class . '($parameters[';
                // Applying intval to the keys prevents code inject on eval
                $code .= implode('],$parameters[', array_map('intval', array_keys($parameters)));
                $code .= ']);';
                eval($code);
                return $obj;
            } else {
                throw new Adept_Exception('Class not found', 0, array('class' => $class));
            }
        }
    } 
    
    /**
     * Returns class as string using algorith: 
     * 1. If method toString exists return it
     * 2. If method __toString exists return it
     * 3. Otherwise return class name of $object
     *
     * @param mixed $object
     * @return string
     */
    public static function toString($object)
    {
        if (is_object($object)) {
            if (method_exists($object, '__toString')) {
                return $object->__toString();
            } elseif (method_exists($object, 'toString')) {
                return $object->toString();
            } else {
                return 'Object[' . get_class($object) . ']';
            }
        } else {
            return $object;
        }
    }
    
    /**
     * Try to extract iterator from object or array
     *
     * @param object|array $object
     * @return Iterator
     * 
     * @throws Adept_Exception_IllegalArgument If cannot recognize object type.
     */
    public static function getIterator($object)
    {
        if (is_array($object)) {
            $arrayObject = new ArrayObject($object);
            return $arrayObject->getIterator();
        } elseif ($object instanceof Iterator) {
            return $object;
        } elseif ($object instanceof IteratorAggregate) {
            return $object->getIterator();
        } else {
            throw new Adept_Exception_IllegalArgument('Cannot retrive iterator from ' . self::toString($object));
        }
    }
    
    /**
     * Returns value of object property.
     *
     * @param object $object
     * @param string $property Property name
     * @param array|string $indexes Property keys or indexes; or array() if nothing
     * @return mixed Property value
     * 
     * @throws Adept_Exception
     */
    static public function getPropertyValue($object, $property, $indexes = array()) 
    {
        if (!is_array($indexes)) {
            $indexes = is_string($indexes) ? array($indexes) : array(); 
        }
        
        if (method_exists($object, 'get' . ucfirst($property)) || method_exists($object, 'is' . ucfirst($property))) {
            $getter = (method_exists($object, 'get' . ucfirst($property)) ? 'get' : 'is') . ucfirst($property); 
            return call_user_func_array(array($object, $getter), $indexes);
        } elseif (property_exists($object, $property)) {
            $result = $object->$property;
            foreach ($indexes as $index) {
                $result = $result[$index];
            }
            return $result;
        } else {
            throw new Adept_Exception("Cannot get property value", 0, array('object' => $object,
                'property' => $property, 'indexes' => implode(', ',$indexes)));
        }
    }    
    
    static public function setPropertyValue($object, $property, $value, $indexes = array()) 
    {
        if (!is_array($indexes)) {
            $indexes = is_string($indexes) ? array($indexes) : array(); 
        }
        
        if (method_exists($object, 'set' . ucfirst($property))) {
            $args = $indexes;
            $args[] = $value;
            call_user_func_array(array($object, 'set' . ucfirst($property)), $args);
        } elseif (property_exists($object, $property)) {         
            if (count($indexes) > 0) {
                $code = '$object->$property[$indexes[' . 
                    implode(']], [$indexes[', array_map('intval', array_keys($indexes))) .  ']] = $value; '; 
                eval($code);
                return ;
            } else {
                $object->$property = $value;
            }
        } else {
            throw new Adept_Exception('Cannot set property', 0, array('object' => $object,
                'property' => $property, 'indexes' => implode(', ', $indexes)));            
        }
    }    
    
}