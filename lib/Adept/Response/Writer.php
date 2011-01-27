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
 * @package    Adept_Response
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Response_Writer
{
    
    protected $response;
    
    protected static $identifierGenerator = 1;
    
    public function __construct($response = null) 
    {
        $this->response = ($response === null) ? Adept_Context::getInstance()->getResponse() : $response;
    }    

    /**
     * @deprecated Use writeTag instead.
     */
    public function writeHtmlTag($name, $attributes = array(), $closed = false) 
    {
        $this->writeTag($name, $attributes, $closed);
    }
    
    protected function escapeAttribute($value)
    {
        if ($value instanceof Adept_Verbatim) { 
            return $value->toString();
        } 
        return str_replace('"', '&quot;', $value);
    }
    
    protected function escapeHtml($value)
    {
        if ($value instanceof Adept_Verbatim) { 
            return $value->toString();
        } 
        if (is_object($value)) {
            $value = Adept_ClassKit_Util::toString($value);
        }
        return htmlspecialchars($value);
    }
    
    public function writeTag($name, $attributes = array(), $closed = false) 
    {
        if (!is_array($attributes)) {
            throw new Adept_Exception('$attributes value must be an array');
        }
        
        $this->write('<' . $name);
        foreach ($attributes as $key => $value) {
            if ($value !== null) {
                if (is_bool($value)) {
                    // Render boolean attribute, skip if false
                    if ($value) {
                        $this->write(' ' . $key . '="' . $key . '"');
                    }
                } else {
                    // Render non attribute 
                    $this->write(' ' . $key . '="' . $this->escapeAttribute($value) . '"');
                }
            }
        }
        
        if ($closed) {
            $this->write(' /');
        }
        
        $this->write('>');
    }     
    
    public function writeTags($tags)
    {
        foreach ($tags as $tagOrContent) {
            if (is_string($tagOrContent)) {
                $this->writeText($tagOrContent);
            } elseif (is_array($tagOrContent)) {
                call_user_func_array(array($this, 'writeTag'), $tagOrContent);
            }
        }
    }
    
    public function writeTagPair($name, $innerText = '', $attributes = array())
    {
        $this->writeTag($name, $attributes);
        if (strlen($innerText) > 0) {
            $this->writeText($innerText);
        }
        $this->writeClosedTag($name);
    }
    
    protected function write($string) 
    {
        $this->response->write($string);
    } 
    
    public function writeHtml($html)
    {
        $this->response->write($html);
    }
    
    public function writeText($html)
    {
        $this->response->write($this->escapeHtml($html));
    }
    
    /**
     * @deprecated User writeClosedTag instead.
     */
    public  function writeClosedHtmlTag($name)
    {
        $this->writeClosedTag($name);
    }
    
    public function writeClosedTag($name)
    {
        $this->write("</{$name}>");
    }
    
    public function writeClosedTagLn($name)
    {
        $this->writeClosedTag($name);
        $this->writeLn();
    }
    
    public function writeLn()
    {
        $this->write("\n");
    }
    
    public function generateIdentifier($prefix = 'var', $postfix = '')
    {
        $result = $prefix . self::$identifierGenerator++ . $postfix;
        // filter
        return preg_replace('~[^\w]~', '_', $result);
    }
    
    public function writeScriptBegin($type = 'text/javascript', $language = 'javascript')
    {
        $this->writeTag('script', array('type' => $type,  'language' => $language));
    }
    
    public function writeScriptEnd()
    {
        $this->writeClosedTag('script');
    }
    
    public function encodeJsString($string)
    {
    
        // Escape these characters with a backslash:
        // " \ / \n \r \t \b \f
        $search  = array('\\', "\n", "\t", "\r", "\b", "\f", '"');
        $replace = array('\\\\', '\\n', '\\t', '\\r', '\\b', '\\f', '\"');
        $string  = str_replace($search, $replace, $string);

        // Escape certain ASCII characters:
        // 0x08 => \b
        // 0x0c => \f
        $string = str_replace(array(chr(0x08), chr(0x0C)), array('\b', '\f'), $string);

        return '"' . $string . '"';
    }
    
    public function writeJsConstructor($className, $args = array(), $ending = ';')
    {
    	$this->write('new ');
    	$this->writeJsFunctionCall($className, $args, $ending);
    }
    
    public function writeJsFunctionCall($function, $args = array(), $ending = ';')
    {
    	$this->write($function . '(');
    	
    	$first = true;
    	foreach ($args as $arg) {
    	    if (!$first) {
    	        $this->write(', ');
    	    } else {
    	        $first = false;
    	    }
    	    $this->writeJsValue($arg);
    	}
    	$this->write(')');
    	if (!empty($ending)) {
    	    $this->write($ending);
    	}
    }

    public function writeJsMethodCall($object, $method, $args = array(), $ending = ';')
    {
        $this->writeJsFunctionCall($object . '.' . $method, $args, $ending);
    }  
    
    public function writeJsValue($value)
    {
        if ($value instanceof Adept_Verbatim) {
            $this->write($value->toString());
        } elseif (is_array($value)) {
            $this->write('[');
            $first = true;
            foreach ($value as $arrayValue) {
                if (!$first) {
                    $this->write(', ');
                }
                $first = false;
                $this->writeJsValue($arrayValue);
            }
            $this->write(']');
        } elseif (is_string($value)) {
            $this->write($this->encodeJsString($value));
        } elseif (is_numeric($value)) {
            $this->write(trim($value));
        } elseif (is_bool($value)) {
            $this->write($value ? 'true' : 'false');
        } elseif (is_null($value)) {
            $this->write('null');
        }  elseif ($value instanceof Adept_Map) {
            $this->write('{');
            $first = true;
            foreach ($value->toArray() as $arrayKey => $arrayValue) {
                if (!$first) {
                    $this->write(', ');
                }
                $first = false;
                $this->writeJsValue($arrayKey);
                $this->write(': ');
                $this->writeJsValue($arrayValue);
            }
            $this->write('}');
        } else {
            throw new Adept_Exception_UnsupportedOperation('Cannot convert object $value to JS', 
                array('valueType' => gettype($value)));
        }
    }
    
}
