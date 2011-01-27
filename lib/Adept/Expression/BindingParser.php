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

class Adept_Expression_BindingParser
{

    /**
     * @param string $string Source expression string
     * @param Adept_Expression_ValueBinding $binding
     * 
     * @return Adept_Expression_ValueBinding 
     */
    public function parseValueBinding($string, $binding = null) 
    {
        if ($binding == null) {
            $binding = new Adept_Expression_ValueBinding();
        }
        
        $match = array();
        
        if (preg_match('~\#(\w+)(?:\[([^\]]+)\])?(?:\-\>(\w+)(?:\[([^\]]+)\])?)?~', $string, $match)) {
            
            $objectId = $match[1];
            $objectIndex = isset($match[2]) && strlen($match[2]) > 0 ? $match[2] : null;
            $property = isset($match[3]) && strlen($match[3]) > 0 ? $match[3] : null;
            $propertyIndex = isset($match[4]) && strlen($match[4]) > 0 ? $match[4] : null;
        } else {
            throw new Adept_Expression_Exception("Invalid value binding syntax: '{$string}' ");
        }
        
        $binding->setObjectId($objectId);
        
        if (!is_null($objectIndex)) {
            $binding->setObjectIndex($objectIndex);
        }
    
        if (!is_null($property)) {
            $binding->setProperty($property);
        }
        if (!is_null($propertyIndex)) {
            $binding->setPropertyIndex($propertyIndex);
        }
        return $binding;
    }
    
    /**
     * @param string $string Source expression string
     * @param Adept_Expression_MethodBinding $binding
     * 
     * @return Adept_Expression_MethodBinding Result binding object
     * @throws 
     */
    public function parseMethodBinding($string, $binding = null) 
    {
        if ($binding == null) {
            $binding = new Adept_Expression_MethodBinding();
        }
        
        $match = array();
        
        if (preg_match('~\#(\w+)(?:\[([^\]]+)\])?\-\>(\w+)~', $string, $match)) {
            $objectId = $match[1];            
            $objectIndex = isset($match[2]) && strlen($match[2]) > 0 ? $match[2] : null;
            $method = $match[3];
        } else {
            throw new Adept_Expression_Exception("Invalid method binding syntax: '{$string}' ");
        }
        
        $binding->setObjectId($objectId);
        
        if (!is_null($objectIndex)) {
             $binding->setObjectIndex($objectIndex);
        }        
        $binding->setMethod($method);
        return $binding;
    }

}
