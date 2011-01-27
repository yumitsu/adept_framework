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
 * @package    Adept_Exception
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Exception_Renderer_Text extends Adept_Exception_Renderer_Abstract
{

    private static $stackTraceLen = null;
    
    public static function setStackTraceLen($stackTraceLen)
    {
        self::$stackTraceLen = $stackTraceLen;
    }
    
    /**
     * Render exception 
     *
     * @param Exception $exception
     * @return string 
     */
    public  function render($exception)
    {
        $result = "\n" . get_class($exception) . ": " . $exception->getMessage()
            . "\n";
            
        $result .= $this->renderParams($exception);
            
        $result .= "        at {$exception->getFile()}:{$exception->getLine()} \n";   
        $result .= $this->renderTrace($exception);
            
        if ($exception instanceof Adept_Exception) {
            if ($exception->getCause() !== null) {
                $result .= "\nCaused by: " . $exception->getCause()->toString();
            }
        }
        return $result;
    }
    
    protected function renderParams($exception)
    {
        $result = '';
        if ($exception instanceof Adept_Exception ) {
            foreach ($exception->getParams() as $key => $value){
                $result .= "        {$key}: " . $this->varDump($value) . "\n";
            }
        }
        return $result;
    }

    protected function renderTrace($exception)
    {
        $result = '';
        
        $min = count($exception->getTrace());
        
        if(self::$stackTraceLen !== null)
        {
            $min = min(self::$stackTraceLen, count($exception->getTrace()));
        }
            
        $traceArr = $exception->getTrace();
        
        for($i = 0; $i < $min; $i++) {
            
            $trace = $traceArr[$i];
            
            $args = array();
            if (isset($trace['args'])) {
                foreach ($trace['args'] as $arg) {
                    $args[] = $this->varDump($arg);
                }    
            }

            $className = isset($trace['class']) ? $trace['class'] : 'undefined';
            $methodName = isset($trace['function']) ? $trace['function'] : 'undefined';
            $type = isset($trace['type']) ? $trace['type'] : 'undefined';
            $line = isset($trace['line']) ? $trace['line'] : 'undefined';
            $file = isset($trace['file']) ? $trace['file'] : 'undefined';
                        
            $result .=  "        at $className$type$methodName($file:$line) \n";
        }
        
        return $result;
    }

}