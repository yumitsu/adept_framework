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

abstract class Adept_Exception_Renderer_Abstract 
{

    protected function cropFile($file, $from, $count)
    {
        if (!file_exists($file)) {
            return '';
        }
        $lines = file($file);     
        if ($from < 0) { 
            $from = 0;
        }
        if ($from + $count > count($lines)) {
            $count = count($lines) - $from;
        }
        // Nothing to return
        if ($count < 0 || count($lines) == 0) {
            return '';
        }
        // Crop
        $lines = array_slice($lines, $from, $count);
        
        return implode('', $lines);
    }
    
    protected function varDump($var, $truncate = true, $truncateSize = 50)
    {
        if (is_array($var)) {
            return 'array()';
        } elseif (is_object($var)) {
            return Adept_ClassKit_Util::toString($var);
        } elseif (is_resource($var)) {
            return 'resource()';
        } elseif (is_string($var)) {
            $var = str_replace("\n", '', $var);
            if ($truncate && strlen($var) > $truncateSize) {
                $var = substr($var, 0, $truncateSize) . '...';
            }
            return "'" . $var . "'";
        }
        return $var;
    }

    /**
     * Render exception 
     *
     * @param Exception $exception
     * @return string 
     */
    abstract function render($exception);

}