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

abstract class Adept_Aop_AbstractProxyObject
{  
    private $realObject;
    private $objectId;
    
    protected $enabledAdvices;
    protected $realObjectClassName;
    
    public function __construct($realObject, $enabledAdvices)
    {
        $this->realObject     = $realObject;
        $this->enabledAdvices = $enabledAdvices;
        
        $refObject = new ReflectionObject($realObject);
        $this->realObjectClassName = $refObject->getName();
        $this->objectId = uniqid();
    }
    
    private function setInvokedMethodContext($advices, $nativeMethod, $args)
    {
        foreach($advices as $advice) {
            $advice->setRealObject($this->realObject);
            $advice->setMethodName($nativeMethod->getName());
            $advice->setArgs($args);
            $advice->setNativeMethod($nativeMethod);
            $advice->setProxyObjectId($this->objectId);
        }
    }
    
    public function __set($name, $value) 
    {
        $this->realObject->$name = $value;
    }
    
    public function __get($name) 
    {
        return $this->realObject->$name;
    }
            
    public function __call($methodName, $args) 
    {
        $advices = $this->getAdvicesForInvokedMethod($methodName);
        $nativeMethod = new ReflectionMethod($this->realObjectClassName, $methodName);
        
        $this->setInvokedMethodContext($advices, $nativeMethod, $args);
                
        $result = null;
        try {
            foreach($advices as $advice) {
                $advice->invokeBeforeMethods();
            }
            $result = $this->invokeNativeOrAround($advices, $nativeMethod, $args);
            foreach($advices as $advice) {
                $advice->invokeAfterMethods();
            }       
        } catch(Exception $e) {
            $this->processException($advices, $e);
        }
        return $result;
    }
    
    private function processException($advices, $e)
    {
        $isExistExceptionMethod = false;
            
        foreach($advices as $advice) {
            if($advice->isExistExceptionMethods()) {
                $isExistExceptionMethod = true;
                $advice->setException($e);
                $advice->invokeCatchExceptionMethods();
            }
        }
        
        if(!$isExistExceptionMethod) {
            throw $e;   
        }
    }
    
    private function invokeNativeOrAround($advices, $nativeMethod, $args)
    {        
        foreach($advices as $advice) {
            if($advice->isExistAroundMethod()) {
                return $advice->invokeAroundMethod();
            }
        }
        return $nativeMethod->invokeArgs($this->realObject, $args);
    }
    
    abstract protected function getAdvicesForInvokedMethod($methodName);
    
}