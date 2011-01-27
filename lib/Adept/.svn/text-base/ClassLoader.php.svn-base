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

class Adept_ClassLoader
{

    protected $beforeLoadListeners = array();
    protected $afterLoadListeners = array();

    protected $calcParsingTime = false;
    protected $parsingTime = 0;
    
    static protected $instance = null;

    protected function __construct()
    {
    }

    /**
     * @return Adept_ClassLoader
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
           self::$instance = new self();
        }
        return self::$instance;
    }

    public function addBeforeLoadListener($listener)
    {
        $this->beforeLoadListeners[] = $listener;
    }

    public function addAfterLoadListener($listener)
    {
        $this->afterLoadListeners[] = $listener;
    }

    /**
     * Add path to include pathes. This is a wrapper for get_include_path/set_include_path functions.
     *
     * @param string $path
     */
    static function addIncludePath($path)
    {
        set_include_path(get_include_path() . PATH_SEPARATOR . $path);
    }

    /**
     * Loads a Php class using naming convention.
     * 
     * @param string $className
     * @return void
     * @throws Adept_Exception
     */
    static function loadClass($className)
    {
        $instance = self::getInstance();
        $instance->_loadClass($className);
    }

    protected function _loadClass($className)
    {
        if (class_exists($className, false) || interface_exists($className,false)) {
            return ;
        }

        if (count($this->beforeLoadListeners) > 0) {
            include_once('Adept/ClassKit/Delegate/List.php');
            Adept_ClassKit_Delegate_List::invokeChain($this->beforeLoadListeners, array($className));
        }
        
        $file = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        
        // Use own "once" algorithm 

        if (!defined('ADEPT_CLASS_LOADER_' . $file)) {
            define('ADEPT_CLASS_LOADER_' . $file, $file);
            $oldErrorReporting = error_reporting();
            error_reporting($oldErrorReporting ^ E_WARNING ^ E_CORE_WARNING ^ E_COMPILE_WARNING ^ E_USER_WARNING);
            if ($this->calcParsingTime) {
                $before = microtime(true);
                include $file;
                $this->parsingTime += microtime(true) - $before;
            } else {
                include $file;    
            }
            error_reporting($oldErrorReporting);
        }
        
        if (count($this->afterLoadListeners) > 0) {
            include_once('Adept/ClassKit/Delegate/List.php');
            Adept_ClassKit_Delegate_List::invokeChain($this->afterLoadListeners, array($className));
        }

        if (!class_exists($className, false) && !interface_exists($className, false)) {
            throw new Adept_Exception("Cannot autoload class or interface [{$className}]");
        }
    }
    
    public static function classExists($className)
    {
        try {
            self::getInstance()->_loadClass($className);
            return true;
        } catch (Adept_Exception $e) {
            return false;
        }
    }
    

    public static function loadFile($fileName, $dirs = array(), $once = true, $require = true)
    {
        $instance = self::getInstance();
        $instance->_loadFile($fileName, $dirs, $once, $require);
    }

    protected function _loadFile($fileName, $dirs = array(), $once = true, $require = true)
    {
        $fullPath = $fileName;

        $incPath = false;
        if (!empty($dirs) && (is_array($dirs) || is_string($dirs))) {
            if (is_array($dirs)) {
                $dirs = implode(PATH_SEPARATOR, $dirs);
            }
            $incPath = get_include_path();
            set_include_path($dirs . PATH_SEPARATOR . $incPath);
        }        
        
        if ($once) {
            if ($require) {
                require_once($fullPath);
            } else {
                include_once($fullPath);
            }
        } else {
            if ($require) {
                require($fullPath);
            } else {
                include($filePath);
            }
        }
        
        if ($incPath) {
            set_include_path($incPath);
        }
        return true;        
    }

    static function init()
    {
        // Add Adept library dir 
        if (!defined('ADEPT_LIB_DIR')) {
            define('ADEPT_LIB_DIR', dirname(__FILE__) . '/..');
        }
        
        self::addIncludePath(ADEPT_LIB_DIR);
        
        // Add predefined Zend library path
        if (defined('ZEND_LIB_DIR')) {
            self::addIncludePath(ZEND_LIB_DIR);
        }
    }
    
    static function autoload($class)
    {
        self::loadClass($class);
    }
    
    static function registerAutoload()
    {
        spl_autoload_register(array('Adept_ClassLoader', 'autoload'));    
    }
    
    public function isCalcParingTime() 
    {
        return $this->calcParsingTime;
    }
    
    public function setCalcParingTime($calcParsingTime) 
    {
        $this->calcParsingTime = $calcParsingTime;
    }
    
    public function getParsingTime() 
    {
        return $this->parsingTime;
    }
    
    public function setParsingTime($parsingTime) 
    {
        $this->parsingTime = $parsingTime;
    }

}

Adept_ClassLoader::init();
Adept_ClassLoader::registerAutoload();
