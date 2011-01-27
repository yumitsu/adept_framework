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
 * @package    Adept_Aop
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Aop_Component_LazyMethod extends Adept_Aop_AnnotatedAdvice  
{
    
    private $returnValues = array();
        
    /**
     * @around
     */
    public function getValue()
    {
        $objectHash = $this->getProxyObjectId();
                
        if (array_key_exists($objectHash, $this->returnValues) 
            && array_key_exists($this->getMethodName(), $this->returnValues[$objectHash])) {
            
            if (is_object($this->returnValues[$objectHash][$this->getMethodName()])
                && ($this->returnValues[$objectHash][$this->getMethodName()] instanceof Exception)) {
                    throw $this->returnValues[$objectHash][$this->getMethodName()];
            }
            
            return $this->returnValues[$objectHash][$this->getMethodName()];
        }
        
        try {
            $returnValue = $this->invokeNativeMethod();
        } catch(Exception $e) {
            $this->returnValues[$objectHash][$this->getMethodName()] = $e;
            throw $e;
        }
                
        $this->returnValues[$objectHash][$this->getMethodName()] = $returnValue;
        return $returnValue;
    }
    
}