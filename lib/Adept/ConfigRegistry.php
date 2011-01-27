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

class Adept_ConfigRegistry 
{
    
    const MODE_REPLACE = 'replace';
    const MODE_APPEND = 'append';

    /**
     * @var Adept_Map
     */
    protected $points;

    /**
     * Class instance
     *
     * @var Adept_ConfigRegistry
     */
    static protected $instance;

    protected function __construct()
    {
        $this->points = new Adept_CanonicalMap();
    }

    /**
     * Get singleton instance
     *
     * @return Adept_ConfigRegistry
     */
    public function getInstance()
    {
        if (null == self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param Adept_Config $extension
     */
    protected function extend($extension)
    {
        $point = $extension['point'];
        $mode = $extension['mode'];
        
        if (!$point) {
            throw new Adept_Exception('Extenstion point is not defined');
        }

        $current = $this->points->get($extension['point']);

        if (!$current) {
            $current = new Adept_Config();
        }
        
        if ($mode == 'replace') {
            
        }
    }
    
    /**
     * @param Adept_Config|string $config Configuration or config file path
     * 
     * @throws Adept_Exception If config cannot be imported
     */
    public function import($config)
    {
        if (is_string($config)) {
            try {
                $config = $this->getConfigLoader()->load($config);
            } catch (Adept_Exception_IllegalArgument $e) {
               $wrapper = new Adept_Exception_IllegalArgument('Import failed');
               $wrapper->initCause($e);
            }
        }
        
        if (!$config instanceof Adept_Config) {
            throw new Adept_Exception('Invalid config parameter');            
        }
        
        // Imports
        foreach ($config->getAsList('import') as $import) {
            $this->import($import['file']);
        }
        
        // Extensions
        foreach ($config->getAsList('extenstion') as $extension) {
            $this->extend($extension);
        }
        
    }
    
    public function getConfig($point)
    {
        return $this->points[$point];
    }

    /**
     * @return Adept_ConfigLoader
     */
    protected function getConfigLoader()
    {
    	return Adept_ConfigLoader::getInstance();
    }
    
}
