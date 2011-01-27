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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Debug 
{

    const EXPRESSION_EVAL_ERRORS = 'expression_eval_errors';
    const TEMPLATE_INCLUDE_LOCATION = 'template_include_location';
    
    protected static $enabled;
    
    protected $options = array();
    
    protected static $instance = null;
    
    // Protected singleton -----------------------------------------------------
    
    protected function __construct()
    {
        if (defined('PRODUCTION')) {
            self::$enabled = !PRODUCTION;
        }
    }
    
    /**
     * @return Adept_Debug
     */
    protected static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    // API methods -------------------------------------------------------------
    
    public static function getOption($name, $default = null)
    {
        $instance = self::getInstance();
        return isset($instance->options[$name]) ? $instance->options[$name] : $default;
    }
    
    public static function getFlag($name)
    {
        $instance = self::getInstance();
        return isset($instance->options[$name]) ? $instance->options[$name] : self::$enabled;
    }
    
    public static function setOption($name, $value)
    {
        $instance = self::getInstance();
        $instance->options[$name] = $value;
    }
    
    public static function isEnabled()
    {
        return self::$enabled;
    }
    
    public static function setEnabled($enabled)
    {
        self::$enabled = $enabled;
    }
    
}
