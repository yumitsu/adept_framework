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
 * @package    Adept_Annotation
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Annotation_Processor
{
    private $methodAnnotationsCache;
    private $classAnnotationsCache;
    
    /**
     * @var Adept_Annotation_Processor
     */
    private static $instance;
    
    /**
     * @return Adept_Annotation_Processor
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Adept_Annotation_Processor();
        }
                
        return self::$instance;
    }
    
    private function __construct()
    { }
    
    private function getClassNameIfObject($classNameOrObject)
    {
        if (is_object($classNameOrObject)) {
            $refObject = new ReflectionObject($classNameOrObject);
            return $refObject->getName();
        }
        return $classNameOrObject;
    }
        
    public function getClassAnnotations($classNameOrObject)
    {
        $className = $this->getClassNameIfObject($classNameOrObject);
                
        if(isset($this->classAnnotationsCache[$className])) {
            return $this->classAnnotationsCache[$className];
        }
        
        $refClass = new ReflectionClass($className);
        $annotations = $this->getAnnotations($refClass->getDocComment());
        $this->classAnnotationsCache[$className] = $annotations;
        
        return $annotations;
    }
       
    public function getMethodAnnotations($classNameOrObject, $methodName)
    {
        $className = $this->getClassNameIfObject($classNameOrObject);
    
        if (isset($this->methodAnnotationsCache[$className][$methodName])) {
            return $this->methodAnnotationsCache[$className][$methodName];
        }   
                     
        $refMethod = new ReflectionMethod($className, $methodName);
        
        $annotations = $this->getAnnotations($refMethod->getDocComment());
        $this->methodAnnotationsCache[$className][$methodName] = $annotations;
        
        return $annotations;
    }

    private function getNameEndPos($doc, $nameStartPos)
    {
        for ($i = $nameStartPos; $i < strlen($doc); $i++) {
            
            switch (ord($doc[$i])) {
                case 9: return $i;
                case 10: return $i;
                case 13: return $i;
            }
            
            switch ($doc[$i]) {
                case '(': return $i;
                case ' ': return $i;
                case '*': if($doc[$i+1] == '/') return $i; break;
            }
        }
    }
            
    private function getAnnotations($doc)
    {
        $annotationArray = array();    
        $startFindPos = 0;
                
        while (true) {
            $nameStartPos = strpos($doc, '@', $startFindPos);
                                                                                  
            if ($nameStartPos === false) {
                return $annotationArray;
            }
            
            $nameStartPos++;            
            $nameEndPos = $this->getNameEndPos($doc, $nameStartPos);
            $name = substr($doc, $nameStartPos, $nameEndPos - $nameStartPos);
                                    
            $startFindPos = $nameEndPos;
            $paramString = "";
                           
            if ($doc[$nameEndPos] === '(') {
                $closeBracketPos = $this->findCloseBracketPos($doc, $nameEndPos);
                
                if ($closeBracketPos !== false) {
                    $startFindPos = $closeBracketPos;
                    $paramLen = $closeBracketPos - $nameEndPos;
                    $paramString = substr($doc, $nameEndPos + 1, $paramLen - 1);
                }
            }
                        
            $annotationArray[$name] = eval("return array(" . $paramString . ");");
        }
    }   
    
    private function passQuotes($doc, $currentPos)
    {        
        if (($doc[$currentPos] == "'") || ($doc[$currentPos] == '"')) {
            $endCuote = $doc[$currentPos];
            for ($i = $currentPos + 1; $i < strlen($doc); $i++) {
                if ($doc[$i] == $endCuote) {
                    if ($doc[$i - 1] === "\\") {
                        continue;
                    }
                    return $i + 1;
                }
            }
        }
        return $currentPos;
    }
    
    private function findCloseBracketPos($doc, $startPos)
    {
        $openBracketCount = 0;
        for($i = $startPos; $i < strlen($doc); $i++) {
            $i = $this->passQuotes($doc, $i);
            if($doc[$i] === '(') {
                $openBracketCount++;
            } elseif ($doc[$i] === ')') {
                if ($openBracketCount == 1) {
                    return $i;
                } 
                $openBracketCount--;
            }
        }
        
        return false;
    }
    
}