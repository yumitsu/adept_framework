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

class Adept_ConfigLoader 
{
    
    const PHP = 'php';
    const XML = 'xml';
    const INI = 'ini';
    
    const CACHE_SERVICE = 'Adept_ConfigLoader';
    const CACHE_GROUP   = 'Adept_ConfigLoader';
    
    /**
     * Configuration locator
     *
     * @var Adept_Locator
     */
    protected $locator;
    
    protected $configs = array();
    
    protected static $instance = null;
    
    protected function __construct()
    {
        $locator = new Adept_Config_Locator();
        $this->setLocator($locator);
    }
    
    static public function setCacheOptions($backend, $options = array())
    {
    	Adept_Cache::getInstance()->addService(self::CACHE_SERVICE, 'Core', $backend, array(), $options);
    }
    
    /**
     * @return Adept_ConfigLoader
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    protected function locale($alias)
    {
        if ($this->getLocator()) {
            try {
                return $this->getLocator()->locate($alias);
            } catch (Adept_Exception $e) {
                return false;
            }
        } else {
            return file_exists($alias) ? $alias : false;            
        }
    }

    /**
     * Try to determinate configuration type, locale config file and load it. 
     *
     * @param string $file Configuration filename or alias 
     * @return Adept_Config
     * 
     * @throws Adept_Exception_IllegalArgument If config type is not supported or file not found.
     */
    public function load($file, $options = array(), $metaType = null)
    {
        $locatedFile = $this->locale($file);
        if ($locatedFile === false) {
            throw new Adept_Exception_IllegalArgument("Cannot locate config file: {$file} ");
        }
        
        // Lookup in locale cache
        if (isset($this->configs[$locatedFile])) {
            return $this->configs[$locatedFile];
        }
        
        // Lookup in cache service
        $cacheService = $this->getCacheService();
        if ($cacheService) {
            $config = $cacheService->load(self::CACHE_GROUP . '_' . md5($locatedFile));
            if ($config) {
                $this->configs[$locatedFile] = $config;
                return $config;                                 
            }
        }
        
        if (null == $metaType) {
            // Cut file extension 
            $dotPos = strrpos($locatedFile, '.');
            if ($dotPos === false) {
                throw new Adept_Exception_IllegalArgument("Cannot determinate config type. Extension not defined. ini, xml and"
                    . " php supported only", array('file' => $file));
            }
        
            $extension = substr($locatedFile, $dotPos + 1);
        } else {
            $extension = $metaType; 
        }
        
        // Match config type
        switch (strtolower($extension)) {
            case self::PHP:
                $config = new Adept_Config_Php($locatedFile, $options);
                break; 
            case self::XML:
                $config = new Adept_Config_Xml($locatedFile, $options);
                break;
            case self::INI:
                $config = new Adept_Config_Ini($locatedFile, $options);
                break;
            default:
                throw new Adept_Exception_IllegalArgument("Cannot determinate config type. ini, xml and"
                    . " php supported only", array('file' => $file));
        }
        
        $this->configs[$locatedFile] = $config;
        
        // Save to cache
        if ($cacheService) {
            $cacheService->save($config, self::CACHE_GROUP . '_' . md5($locatedFile));
        }
        
        return $config;
    }
    
    /**
     * @return Zend_Cache_Core
     */
    public function getCacheService()
    {
    	return Adept_Cache::getInstance()->getService(self::CACHE_SERVICE);
    }
    
    /**
     * Return current locator instance.
     *
     * @return Adept_Locator
     */
    public function getLocator()
    {
        return $this->locator;
    }
    
    public function setLocator($locator)
    {
        $this->locator = $locator;
    }
    
}