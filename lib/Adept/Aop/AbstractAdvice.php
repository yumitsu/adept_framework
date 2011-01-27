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

abstract class Adept_Aop_AbstractAdvice
{
    private $realObject;
    private $exception;
    private $methodName;
    private $args;
    private $nativeMethod;
    private $proxyObjectId;
    private $order = 0;
    
    public function setOrder($order)
    {
        $this->order = $order;
    }
    
    public function getOrder()
    {
        return $this->order;
    }
    
    public function setProxyObjectId($proxyObjectId)
    {
        $this->proxyObjectId = $proxyObjectId;
    }
    
    public function getProxyObjectId()
    {
        return $this->proxyObjectId;
    }
                
    public function setRealObject($realObject)
    {
        $this->realObject = $realObject;
    }
    
    public function getRealObject()
    {
        return $this->realObject;
    }
    
    public function setException($exception)
    {
        $this->exception = $exception;
    }
    
    public function getException()
    {
        return $this->exception;
    }
    
    public function setMethodName($methodName)
    {
        $this->methodName = $methodName;
    }
    
    public function getMethodName()
    {
        return $this->methodName;
    }
    
    public function setArgs($args)
    {
        $this->args = $args;
    }
    
    public function getArgs()
    {
        return $this->args;
    }
    
    public function setNativeMethod($nativeMethod)
    {
        $this->nativeMethod = $nativeMethod;
    }
    
    public function getNativeMethod()
    {
        return $this->nativeMethod;
    }
    
    public function invokeNativeMethod()
    {
        return $this->getNativeMethod()->invokeArgs($this->getRealObject(), $this->getArgs());
    }
    
    abstract public function invokeBeforeMethods();
    abstract public function invokeAfterMethods();
    abstract public function invokeCatchExceptionMethods();
    abstract public function invokeAroundMethod();
    abstract public function isExistAroundMethod();
    abstract public function isExistExceptionMethods();
}
