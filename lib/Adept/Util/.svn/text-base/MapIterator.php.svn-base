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
 * @package    Adept_Util
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Util_MapIterator implements Adept_CollectionIterator  
{

    /**
     * @var Adept_Map
     */
    private $map;

    private $count = null;
    private $index;
    private $keys;
    
    private $current;
    private $skipOnNext = false;

    public function __construct($map)
    {
        $this->map = $map;
    }
    
    public function setCollection($collection)
    {
        $this->map = $collection;
    }
    
    // Map iterator -----------------------------------------------------------
    
    public function add($item)
    {
        $this->map->add($item);
        $this->keys = $this->map->keys();
    }
    
    public function remove($item)
    {
        $key = $this->map->indexOf($item);
        if ($key !== false) {
            $keyIndex = array_search($key, $this->keys);
            $this->map->remove();
            $this->keys = $this->map->keys();
            
            if ($this->index >= $keyIndex) {
                $this->skipOnNext = true;
            }
        }
    }
    
    public function rewind()
    {
        $this->keys = $this->map->keys();
        $this->index = 0;        
        $this->current = $this->map->get($this->key());
    }
    
    public function next()
    {
        if (!$this->skipOnNext) {
            $this->index++;
        } else {
            $this->skipOnNext = false;
        }
        $this->current = $this->map->get($this->key());
    }
    
    public function valid()
    {
        return ($this->index >= 0 && $this->index < count($this->keys));
    }
    
    public function key()
    {
        return isset($this->keys[$this->index]) ? $this->keys[$this->index] : null;
    }
    
    public function current()
    {
        return $this->current;
    }
    
    public function set($object)
    {
        $this->map->set($this->key(), $object);
    }
    
}
