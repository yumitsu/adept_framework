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
 * @package    Adept_Expression
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Expression_Resolver_Property
{
    
    
    public function getValue($object, $property, $propertyIndex = null)
    {
        if (!is_object($object)) {
            throw new Adept_Expression_Exception('Cannot get property of a non object', 
                array('property' => $property, 'propertyIndex' => $propertyIndex));
        }
        
        if ($object instanceof Adept_ClassKit_Proxy) {
            $object = $object->resolve();
        }

        $getter = 'get' . ucfirst($property);
        if (!method_exists($object, $getter)) {
            $getter = 'is' . ucfirst($property);
            if (!method_exists($object, $getter)) {
                if (property_exists($object, $property)) {
                    // Get property directly
                    if (!is_null($propertyIndex)) {
                        return $object->$property[$propertyIndex];
                    } else {
                        return $object->$property;
                    }
                }
                throw new Adept_Expression_Exception("Cannot get property value", 
                    array('object' => Adept_ClassKit_Util::toString($object),
                        'property' => $property,
                        'propertyIndex' => $propertyIndex));
            }
        }
        
        // Get proeprty value via getter
        
        if (!is_null($propertyIndex)) {
            return $object->$getter($propertyIndex);
        } else {
            return $object->$getter();
        }
                
    }
    
    public function setValue($object, $property, $value, $propertyIndex = null)
    {
        if (!is_object($object)) {
            throw new Adept_Expression_Exception('Cannot set property of a non object', 
                array('property' => $property, 'propertyIndex' => $propertyIndex));
        }
    
        if ($object instanceof Adept_ClassKit_Proxy) {
            $object = $object->resolve();
        }
        
        $setter = 'set' . ucfirst($property);
        
        if (!method_exists($object, $setter)) {
            
            if (property_exists($object, $property)) {
                // Set property value directly
                if (!is_null($propertyIndex)) {
                    $object->$property[$propertyIndex] = $value;
                } else {
                    $object->$property = $value;
                }
                return;
            }
            
            throw new Adept_Expression_Exception("Cannot set property", 
                array('object' => Adept_ClassKit_Util::toString($object),
                    'property' => $property,
                    'propertyIndex' => $propertyIndex));
        }
        
        // Set property via setter
        
        if (!is_null($propertyIndex)) {
            $object->$setter($propertyIndex, $value);
        } else {
            $object->$setter($value);
        }
    }
    
    public function isReadOnly($object, $property)
    {
        if (!is_object($object)) {
            return true;
        }
        if ($object instanceof Adept_ClassKit_Proxy) {
            $object = $object->resolve();
        }
        $setter = 'set' . ucfirst($property);
        if (!method_exists($object, $setter)) {
            if (property_exists($object, $property)) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

}
