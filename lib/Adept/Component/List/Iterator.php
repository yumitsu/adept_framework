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
 * @package    Adept_Component
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Component_List_Iterator implements Iterator, Countable   
{
    
    /**
     * @var Adept_Component_List_Abstract
     */
    protected $list;
    
    /**
     * @var Iterator
     */
    protected $iterator;
    
    public function __construct($list, $from)
    {
        $this->list = $list;
        $this->extractIterator($from);
    }
    
    protected function extractIterator($from)
    {
        $this->iterator = null;
        if (is_array($from)) {
            $this->iterator = new ArrayIterator($from);
        } elseif ($from instanceof Iterator) {
            $this->iterator = $from;
        } elseif ($from instanceof IteratorAggregate) {
            $this->iterator = $from->getIterator();
        }        
        
        if ($this->iterator === null) {
            return ;
        }
        
        if (is_array($from) || $from instanceof Countable) {
            $this->getListProperties()->setCount(count($from));
        } else {
            $this->getListProperties()->setCount(-1);
        }
    }
        
    /**
     * @var Adept_Component_List_Properties
     */
    protected function getListProperties()
    {
        return $this->list->getListProperties();
    }
    
    public function rewind()
    {
        if ($this->iterator == null) {
            return ;
        }
        $this->getListProperties()->setIndex(0);
        $this->iterator->rewind();
    }
    
    public function valid()
    {
        if ($this->iterator != null) {
            return $this->iterator->valid();
        }
        return false;
    }
    
    public function next()
    {
        $this->iterator->next();
        $this->getListProperties()->setIndex($this->getListProperties()->getIndex() + 1);
    }
    
    public function current()
    {
        return $this->iterator->current();    
    }
    
    public function key()
    {
        return $this->iterator->key();
    }
    
    public function count()
    {
        return $this->getListProperties()->getCount();
    }

    public function isEmpty()
    {
        return $this->iterator === null || $this->count() == 0;
    }
    
}
