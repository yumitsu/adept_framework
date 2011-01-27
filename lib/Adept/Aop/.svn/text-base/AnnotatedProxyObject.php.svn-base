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

class Adept_Aop_AnnotatedProxyObject extends Adept_Aop_AbstractProxyObject 
{
    protected function getAdvicesForInvokedMethod($methodName)
    {
        $className = $this->realObjectClassName;
                        
        $annotationProcessor = Adept_Annotation_Processor::getInstance();
        
        $methodAnnotations = $annotationProcessor->getMethodAnnotations($className, $methodName);
        $classAnnotations  = $annotationProcessor->getClassAnnotations($className);
        
        $annotations = array_merge($classAnnotations, $methodAnnotations);
                        
        $advicesForMethod = array();
                        
        foreach($annotations as $annotationName => $annotationParams) {
            if(isset($this->enabledAdvices[$annotationName])) {
                $advice = $this->enabledAdvices[$annotationName];
                
                foreach($annotationParams as $paramName => $paramValue) {
                    $adviceMethodName = set . ucfirst($paramName);
                    $advice->$adviceMethodName($paramValue);
                }                
                                                
                $advicesForMethod[] = $advice;
            }
        }
                        
        usort($advicesForMethod, array($this, "cmpAdviceHandlers"));                
        return $advicesForMethod;
    }
    
    private function cmpAdviceHandlers($a, $b)
    {
        if ($a->getOrder() == $b->getOrder()) {
            return 0;
        }
        return ($a->getOrder() > $b->getOrder()) ? +1 : -1;
    }    
}