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
 * @package    Adept_Template
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Template_PhpWriter
{

    const PHP_MODE = 1;
    const HTML_MODE = 2;

    protected $code;
    protected $includes = array();
    protected $mode;

    protected $parameters;
    protected $tempVar = 1;
    protected static $identSuffix = 1;

    public function __construct()
    {
        $this->parameters = new Adept_Map();
        $this->code = '';
        $this->mode = self::HTML_MODE;
    }

    public function getCode()
    {
        if (count($this->includes) > 0) {
            $includeCode = '';
            foreach ($this->includes as $includeFile)
            $includeCode .= "require_once('$includeFile');\n";
            return '<?php ' . $includeCode . ' ?>' . $this->code;
        } else {
            return $this->code;
        }
    }
    
    public function getParameter($name, $defaultValue = null)
    {
        return ($this->parameters->has($name)) ? $this->parameters->get($name) : $defaultValue;
    }

    public function setParameter($name, $value)
    {
        $this->parameters->set($name, $value);
    }

    public function registerInclude($includeFile)
    {
        if (!in_array($includeFile, $this->includes)) {
            $this->includes[] = $includeFile;
        }
    }

    public function writePhp($str)
    {
        $this->switchToPhp();
        $this->code .= $str;
    }

    public function writePhpLiteral($str, $escape = true, $doubleQuotes = false)
    {
        $this->switchToPhp();
        if (!$doubleQuotes) {
            if ($escape) $str = $this->escapeLiteral($str);
            $this->code .= "'" . $str . "'";
        } else {
            $str = addslashes($str);
            $this->code .= '"' . $str . '"';
        }
    }
    
    public function writePhpBoolean($flag)
    {
        $this->writePhp($flag ? 'true' : 'false');
    }

    public function writePhpVarExport($data)
    {
        $this->switchToPhp();
        $this->code .= var_export($data, true);
    }

    public function escapeLiteral($text)
    {
        $text = str_replace('\'', "\\'", $text);
        // Check it
        $text = str_replace('\\\\\'', "\\\\\\'", $text); 
        if (substr($text, -1) == '\\') {
            $text .= '\\';
        }
        return $text;
    }

    public function writeHtml($str)
    {
        $this->switchToHtml();
        $this->code .= $str;
    }

    public function beginClass($name, $superClass = null)
    {
        $this->writePhp('class ' . $name);
        if (null != $superClass) {
            $this->writePhp(' extends ' . $superClass);
        }
        $this->writePhp("\n{\n");
    }

    public function endClass()
    {
        return $this->writePhp("\n}\n");
    }

    public function generateIdent($prefix = 'tpl')
    {
        return $prefix . self::$identSuffix++;
    }

    public function generateVar($prefix = '$var')
    {
        return $this->generateIdent($prefix);
    }

    public function beginFunction($name = null, $params = '', $secutiry = '') 
    {
        if (null == $name) {
            $name = $this->generateIdent();
        }
        if (null != $secutiry) {
            $this->writePhp($secutiry . ' ');
        }
        $this->writePhp("function {$name}({$params})\n{\n");
        return $name;
    }

    public function endFunction() 
    {
        $this->writePhp("\n}\n");
    }

    public function setFunctionPrefix($prefix) 
    {
        $this->functionPrefix = $prefix;
    }

    public function switchToPhp() 
    {
        if ($this->mode == self::HTML_MODE) {
            $this->mode = self::PHP_MODE;
            $this->code .= '<?php ';
        }
    }

    public function switchToHtml() 
    {
        if ($this->mode == self::PHP_MODE) {
            $this->mode = self::HTML_MODE;
            $this->code .= ' ?>';
        }
    }

}
