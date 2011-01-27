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

class Adept_Config extends Adept_Map 
{
    
    public function get($key, $defaultValue = null)
    {
        $value = parent::get($key);
        return (null !== $value) ? $value : $defaultValue;
    }
    
    public function getBool($key, $defaultValue = false)
    {
        $value = $this->get($key);
        if (null !== $value) {
            return in_array(strtolower($value), array('true', 't', '1', 'yes')); 
        } else {
            return $defaultValue;
        }
    }
    
    /**
     * Wraps config value by {@link Adept_List}.
     *
     * @param string $key
     * @return Adept_List
     */
    public function getAsList($key)
    {
        $value = $this->get($key);

        if ($value instanceof Adept_List) {
            return $value;
        }
        
        $list = new Adept_List();
        if (null !== $value) {
            $list->add($value);
        }
        return $list;
    }
    
    /**
     * Returns config node by path
     *
     * @param string $path
     * @param string $separator
     * @return mixed Returns found value or null if nothing found or path wrong.
     */
    public function getByPath($path, $separator = '/')
    {
        $nodes = explode($separator, $path);
        $config = $this;
        foreach ($nodes as $node) {
            if (strlen(trim($node)) == 0) {
                continue;
            }
            if (!$config instanceof Adept_Config) {
                return null;
            }
            $config = $config->get($node);
        }
        return $config;
    }
    
    public function merge($collection)
    {
        foreach ($collection as $key => $value) {
            if ($this->has($key)) {
                // Key exists
                $current = $this->get($key);
                if ($current instanceof Adept_List) {
                    // Current already list
                    if ($value instanceof Adept_List) {
                        $current->merge($value);
                    } else {
                        $current->add($value);
                    }
                } else {
                    $list = new Adept_List();
                    $list->add($current);
                    if ($value instanceof Adept_List) {
                        $list->merge($value);
                    } else {
                        $list->add($value);
                    }
                    $this->set($key, $list);
                }
            } else {
                $this->set($key, $value);
            }
        }
    }
    
    public function toArray()
    {
        $result = array();
        foreach ($this as $key => $value) {
            if ($value instanceof Adept_Config || $value instanceof Adept_List) {
                $value = $value->toArray();
            }
            $result[$key] = $value;
        }
        return $result;
    }
    
}