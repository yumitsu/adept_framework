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

class Adept_Map extends Adept_Access implements Adept_Collection
{

    /**
     * @var array
     */
    private $map = array();
    
    /**
     * Constructs a map. 
     *
     * @param Adept_Map|Adept_List|array $collection Initial collection 
     */
    public function __construct($collection = null)
    {
        if ($collection !== null) {
            $this->merge($collection);
        }
    }
    
    /**
     * Appends the specified value to the end of this map, key generates automatically. 
     *
     * @param mixed $value 
     * @return void
     */    
    public function add($value)
    {
        $this->map[] = $value;
    }
    
    /**
     * Returns the value to which the specified key is mapped in this identity hash map, or null if the map contains 
     * no mapping for this key.
     *
     * @param string $key the key whose associated value is to be returned.
     * @return mixed the value to which this map maps the specified key, or null if the map contains no mapping for 
     *         this key.
     */
    public function get($key)
    {
        return $this->has($key) ? $this->map[$key] : null;     
    }
   
    /**
     * Associates the specified value with the specified key in this map. If the map previously contained a mapping for 
     * this key, the old value is replaced.
     *
     * @param string $key with which the specified value is to be associated.
     * @param mixed $value to be associated with the specified key.
     * @return void
     */
    public function set($key, $value)
    {
        $this->map[$key] = $value;
    }
    
    /**
     * Returns true if this map contains a mapping for the specified key.
     *
     * @param string $key
     * @return boolean if this map contains a mapping for the specified key.
     */
    public function has($key)
    {
        return isset($this->map[$key]);
    }
    
    /**
     * Returns true if this map maps one or more keys to the specified value.
     *
     * @param mixed $value
     * @return boolean true if this map maps one or more keys to the specified value.
     */
    public function contains($value)
    {
        return (boolean) $this->indexOf($value) !== false;
    }
    
    /**
     * Returns key of first value occurence, false otherwise.  
     *
     * @param mixed $value
     * @return string|boolean
     */
    public function indexOf($value)
    {
        foreach ($this->map as $key => $item){
            if ($item === $value) {
                return $key;
            }
        }
        return false;
    }
    
    public function merge($collection)
    {
        if (is_array($collection) || $collection instanceof Adept_Map) {
            foreach ($collection as $key => $value) {
                $this->set($key, $value);
            }
        } elseif ($collection instanceof Adept_List) {
            foreach ($collection as $value) {
                $this->add($value);
            }
        } else {
            throw new Adept_Exception('Unsupported operand type');
        }
    }
    
    // Countable --------------------------------------------------------------
    
    /**
     * Returns the number of key-value mappings in this map.
     *
     * @return int the number of key-value mappings in this map.
     */
    public function count()
    {
        return count($this->map);
    }
    
    // IteratorAggregate ------------------------------------------------------
    
    /**
     * Returns iterator instance for this map.
     *
     * @return Adept_Util_MapIterator
     */
    public function getIterator()
    {
        return new Adept_Util_MapIterator($this);
    }
    
    /**
     * Returns true if this map contains no key-value mappings.
     *
     * @return boolean true if this map contains no key-value mappings.
     */
    public function isEmpty()
    {
        return (boolean) $this->count() === 0;
    }
    
    /**
     * Converts native array for this map
     *
     * @return array 
     */
    public function toArray()
    {
        return $this->map;
    }
    
    /**
     * Returns a array view of the keys contained in this map.
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->map);
    }
    
    /**
     * Returns a array view of the values contained in this map.
     *
     * @return array
     */    
    public function values()
    {
        return array_values($this->map);
    }
    
    /**
     * Removes the mapping for this key from this map if present.
     *
     * @param string $key key whose mapping is to be removed from the map.
     * @return boolean true if value removed; false otherwise.
     */
    public function remove($key)
    {
        if (isset($this->map[$key])) {
            unset($this->map[$key]);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Removes all mappings from this map.
     * 
     * @return void
     */
    public function removeAll()
    {
        $this->map = array();
    }
    
}
