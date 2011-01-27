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

/**
 * Adept resource locator.
 * 
 */
class Adept_Locator 
{

    /**
     * @var array String array of locations 
     */
    protected $locations = array();
    
    /**
     * @var Alias pattern
     */
    protected $aliasFormat;

    public function __construct($locations = array('.'), $aliasFormat = '*')
    {
        $this->locations = $locations;
        $this->aliasFormat = $aliasFormat;
    }

    /**
     * Locate resource. 
     *
     * @param string $alias
     * @param array $params
     * @return string|null Full patj to resource.
     * 
     * @throws Adept_Locator_Exception
     */
    public function locate($alias, $params = array())
    {
        $alias = $this->processAlias($alias);
        
        $paths = $this->locations;
        
        if (file_exists($alias)) {
            return $alias;
        }
        
        foreach ($paths as $path) {
            if (file_exists($path . '/' . $alias)) {
                return $path . '/' . $alias;
            }
        }
        
        $this->unresolvedAlias($alias);
        
        return null;
    }
    
    /**
     * Try to locate resource. Returns full path to resource or null if nothing found.
     *
     * @param string $alias Resource alias.
     * @param array $params Custom parameters.
     * @return string|null Full path to resource or null if nothing found.
     */
    public function tryToLocate($alias, $params = array())
    {
        try {
            $result = $this->locate($alias);
            return $result;
        } catch (Adept_Locator_Exception $e) {
            return null;
        }
    }

    /**
     * Append new location 
     *
     * @param string $location
     */
    public function addLocation($location)
    {
        $this->locations[] = $location;
    }
    
    /**
     * Append collection of locations.
     *
     * @param array|Iterator $locations
     */
    public function addLocations($locations)
    {
        foreach ($locations as $location) {
            $this->addLocation($location);
        }
    }

    /**
     * Returns all defined locations. 
     * 
     * @return array
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Locale all 
     *
     * @param string $prefix
     * @return array
     */
    public function locateAll($prefix = '')
    {
        $result = array();
        $paths = $this->locations;
        foreach ($paths as $path) {
            if ($files = glob($path . $prefix . $this->aliasFormat)) {
                $result = array_merge($result, $files);
            }
        }
        return array_unique($result);
    }

    /**
     * Process alias using $aliasFormat.
     *
     * @param string $alias
     * @return string
     */
    protected function processAlias($alias)
    {
        return str_replace('*', $alias, $this->aliasFormat);
    }

    /**
     * Handle "unresolved alias" situation. 
     * 
     * @param string $alias
     * @throws Adept_Locator_Exception 
     */
    protected function unresolvedAlias($alias)
    {
        throw new Adept_Locator_Exception("Cannot locate resource. "
            . "Alias: {$alias}. Locator: " . get_class($this) . ".",
            array('alias' => $alias, 'locator' => get_class($this)));
    }

}

