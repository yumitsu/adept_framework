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

class Adept_Aop_AnnotatedAdvice extends Adept_Aop_AbstractAdvice 
{
    private static $globalAdviceAnnotatedMethodsCache;
        
    private function prepareCache($className)
    {
        $annotationProcessor = Adept_Annotation_Processor::getInstance();
        
        $methodsGroups = array(
            'before' => array(),
            'around' => array(),
             'after' => array(),
            'catchException' => array(),
        );
        
        $refClass = new ReflectionClass($className);
        $refMethods = $refClass->getMethods();
        
        foreach($refMethods as $refMethod) {
            
            $methodAnnotations = $annotationProcessor->getMethodAnnotations($className, $refMethod->getName());
            
            foreach($methodAnnotations as $annotationName => $annotation) {
                if (key_exists($annotationName, $methodsGroups)) {
                    $selfInvokableMethod = new Adept_Aop_SelfInvokableMethod($refMethod, $this);
                    if(isset($annotation['order'])) {
                        $selfInvokableMethod->setOrder($annotation['order']);
                    }
                    $methodsGroups[$annotationName][] = $selfInvokableMethod;
                }
            }
        }
        
        foreach($methodsGroups as $annotationName => $group) {
            usort($group, array($this, "cmpMethods"));
            self::$globalAdviceAnnotatedMethodsCache[$className][$annotationName] = $group; 
        }
    }
                
    private function getAnnotatedMethods($annotationName)
    {   
        $className = get_class($this);
        if (isset(self::$globalAdviceAnnotatedMethodsCache[$className][$annotationName])) {
            return self::$globalAdviceAnnotatedMethodsCache[$className][$annotationName];
        }
        $this->prepareCache($className);
        
        return self::$globalAdviceAnnotatedMethodsCache[$className][$annotationName];
    }
        
    private function cmpMethods($a, $b)
    {
        if ($a->getOrder() == $b->getOrder()) {
            return 0;
        }
        return ($a->getOrder() > $b->getOrder()) ? +1 : -1;
    }
    
    private function invokeMethods($annotation)
    {
        $methods = $this->getAnnotatedMethods($annotation);
        foreach($methods as $method) {
            $method->invoke();
        }
    }
       
    public function invokeBeforeMethods()
    {
        $this->invokeMethods('before');
    }
    
    public function invokeAfterMethods()
    {
        $this->invokeMethods('after');
    }
        
    public function invokeCatchExceptionMethods()
    {
        $this->invokeMethods('catchException');
    }
    
    public function isExistAroundMethod()
    {
        $methods = $this->getAnnotatedMethods('around');
        if(count($methods) !== 0) {
            return true;
        }
        return false;
    }
    
    public function invokeAroundMethod()
    {
        $methods = $this->getAnnotatedMethods('around');
        if(count($methods) !== 0) {
            return $methods[0]->invoke();    
        }
    }
    
    public function isExistExceptionMethods()
    {
        $methods = $this->getAnnotatedMethods('catchException');
        if (count($methods) !== 0) {
            return true;
        }
        return false;
    }
    
}