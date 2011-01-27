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
 * @package    Adept_Debug
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Debug_Backtrace 
{
    protected $backtrace;

    public function __construct($backtrace)
    {
        $this->backtrace = $backtrace;
    }
    
    public function toString()
    {
        $html = php_sapi_name() != 'cli';

        $str = '';
        foreach($this->backtrace as $bc) {
            if(isset($bc['class'])) {
                $s = ($html ? "<b>%s</b>" : "%s") . "::";
                $str .= sprintf($s, $bc['class']);
            }

            if (isset($bc['function'])) {
                $s = ($html ? "<b>%s</b>" : "%s");
                $str .= sprintf($s, $bc['function']);
            }

            $str .= ' (';
            if(isset($bc['args'])) {
                foreach($bc['args'] as $arg) {
                    $s = ($html ? "<i>%s</i>, " : "%s, ");
                    $type = gettype($arg);

                    if ($type == "string") {
                        $str .= sprintf($s, '"' . preg_replace('~^(.{150})(.*)$~', '$1...', $arg) . '"');
                    } elseif($type == "object") {
                        $str .= sprintf($s, get_class($arg));
                    } elseif($type == "array") {
                        $arr = array();
                        foreach($arg as $key => $value) {
                            if (is_object($value)) {
                                $value = "Object of class " . get_class($value);    
                            }
                            $arr[] = "[$key] => $value";
                        }
                        $str .= sprintf($s, implode(',', $arr));
                    } elseif($type == "integer" || $type == "float") {
                        $str .= sprintf($s, $arg);
                    } else {
                        $str .= sprintf($s, $type);
                    }
                }
                if (count($bc['args']) > 0) {
                    $str = substr($str, 0, -2);
                }
            }

            $str .= ')';
            $str .= ': ';
            $str .= '[ ';
            if (isset($bc['file'])) {
                $dir = substr(dirname($bc['file']), strrpos(dirname($bc['file']), '/') + 1);
                $file = basename($bc['file']);
                if ($html) {
                    $str .= "<a href=\"file:/" . $bc['file'] . "\">";
                }
                $str .= $dir . '/' . $file;
                if ($html) {
                    $str .= "</a>";
                }
            }
            $str .= isset($bc['line']) ? ', ' . $bc['line'] : '';
            $str .= ' ] ';
            $str .= ($html ? "<br />\n" : "\n");
        }
        return $str;
  }

}