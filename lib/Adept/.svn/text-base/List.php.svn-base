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

class Adept_List implements Adept_Collection, ArrayAccess, Adept_ClassKit_Comparable
{

    /**
     * @var array
     */
    private $items = array();

    /**
     * List constuctor. 
     *
     * @param Adept_Collection|array $list Initial collection or array.
     */
    public function __construct($collection = null)
    {
        if ($collection != null) {
            $this->merge($collection);
        }
    }
    
    /**
     * Throws exception if $index is not in a valid range
     *
     * @param int $index
     * @return void
     * @throws Adept_Exception
     */
    private function validateBounds($index)
    {
        if ($index < 0 || $index >= $this->count()) {
            throw new Adept_Exception('Index out of bounds');
        }
    }
    
    /**
     * Appends the specified item to the end of this list.
     *
     * @param mixed $item
     * @return void
     */
    public function add($item)
    {
        $this->items[] = $item;
    }
    
    /**
     * Returns the item at the specified position in this list.
     *
     * @param int $index 
     * @return mixed item if found; null otherwise.
     */
    public function get($index)
    {
        return isset($this->items[$index]) ? $this->items[$index] : null;
    }
    
    /**
     * Replaces the item at the specified position in this list with the specified item.
     *
     * @param int $index index of item to replace.    
     * @param mixed $item
     * @return void
     * @throws Adept_Exception if $index is out ou bounds ($index < 0 || $index > count()).
     */
    public function set($index, $item)
    {
        if ($index >= 0 && $index < $this->count()) {
            $this->items[$index] = $item;
        } elseif ($index == $this->count()) {
            $this->add($item);
        } else {
            throw new Adept_Exception('Index out of bounds');        
        }
    }
        
    /**
     * Append collection or array to this list
     *
     * @param Adept_Collection|array $collection
     */
    public function merge($collection)
    {
        foreach ($collection as $item) {
            $this->add($item);
        }
    }
    
    /**
     * Returns the number of elements in this list.
     *
     * @return int the number of elements in this list.
     */
    public function count()
    {
        return count($this->items);
    }
    
    /**
     * Exchange two items in list
     *
     * @param int $index1
     * @param int $index2
     */
    public function exchange($index1, $index2)
    {
        $_tmp = $this->items[$index1];
        $this->items[$index1] = $this->items[$index2];
        $this->items[$index2] = $_tmp;
    }

    /**
     * Move item to another index 
     *
     * @param int $sourceIndex
     * @param int $destIndex
     */
    public function move($sourceIndex, $destIndex)
    {
        $item = $this->items[$sourceIndex];
        array_splice($this->items, $sourceIndex, 1);
        array_splice($this->items, $destIndex, 0, array($item));
    }
    
    /**
     * Reverse list items order
     *
     */
    public function reverse()
    {
        $this->items = array_reverse($this->items);
    }
    
    /**
     * Tests if this list has no elements.
     *
     * @return boolean true if this list has no elements, false otherwise.
     */
    public function isEmpty()
    {
        return $this->count() === 0;
    }
    
    /**
     * Returns true if this list contains the specified item.
     * 
     * @return boolean true if this list contains the specified item; false otherwise.
     */
    public function contains($item)
    {
        return (boolean) ($this->indexOf($item) !== false);
    }
        
    /**
     * Searches for the first occurence of the given item.
     *
     * @param mixed $item
     * @return int|boolean the index of the item in this list; returns false 
     *         if the object is not found.
     */
    public function indexOf($item)
    {
        for ($index = 0; $index < $this->count(); $index++) {
            if ($this->get($index) === $item) {
                return $index;
            }
        }
        return false;
    }
    
    /**
     * Insert item at $index position.
     *
     * @param int $index
     * @param mixed $value
     */
    public function insert($index, $value)
    {
        array_splice($this->items, $index, 0, array($value));
    }

    /**
     * Insert items at $index position.
     *
     * @param int $index
     * @param Adept_Collection|array $collection
     */
    public function insertAll($index, $collection)
    {
        if ($collection === null) {
            return ;
        }
        if (!is_array($collection) && !$collection instanceof Adept_Collection) {
            throw new Adept_Exception_IllegalArgument('$collection is not a Adept_Collection or Array');
        }
        
        if ($collection instanceof Adept_Collection) {
            $collection = $collection->toArray();
        }

        array_splice($this->items, $index, 0, $collection);
    }
    
    /**
     * Returns the index of the last occurrence of the specified object in this list.
     * 
     * @param mixed $item an object or value
     * @return int|boolean the index of the item in this list; returns false 
     *         if the object is not found.
     */
    public function lastIndexOf($item)
    {
        $lastIndex = null;
        for ($index = 0; $index < $this->count(); $index++) {
            if ($this->get($index) === $item) {
                $lastIndex = $index;
            }
        }
        return isset($lastIndex) ? $lastIndex : false;
    }
    
    /**
     * Returns the index of the first occurrence of the specified object in this list.
     * 
     * @param mixed $item an object or value
     * @return int|boolean the index of the item in this list; returns false 
     *         if the object is not found.
     */
    
    public function firstIndexOf($item)
    {
        for ($index = 0; $index < $this->count(); $index++) {
            if ($this->get($index) === $item) {
                return $index;
            }
        }
        return false;
    }
    
    /**
     * Removes the element at the specified position in this list. Shifts any subsequent elements to the left
     *
     * @param int $index the index of the item to removed
     */
    public function remove($index)
    {
        $this->validateBounds($index);
        
        array_splice($this->items, $index, 1);
    }
    
    /**
     * Removes all of the elements from this list. The list will be empty after this call returns.
     *
     * @return void
     */
    public function removeAll()
    {
        $this->items = array();   
    }
    
    /**
     * Returns current list as array.
     *
     * @return array current list items in numeric array.
     */
    public function toArray()
    {
        return $this->items;
    }
    
    // IteratorAggregate ------------------------------------------------------
    
    /**
     * Returns list iterator for this object
     *
     * @return Adept_Util_ListIterator
     */
    public function getIterator()
    {
        return new Adept_Util_ListIterator($this);
    }
    
    public function compareTo($instance)
    {
        if (!$instance instanceof Adept_List) {
            return false;
        }
        return $this->items == $instance->toArray();
    }
    
    // ArrayAccess ------------------------------------------------------------
    
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    public function offsetExists($offset)
    {
        return $offset >= 0 && $offset < $this->count();
    }
    
}
