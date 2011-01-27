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

class Adept_Component_List_Properties implements ArrayAccess 
{

    protected $index;
    protected $count;

    public function getIteration() 
    {
        return $this->index + 1;
    }
    
    public function getIndex()
    {
        return $this->index;
    }
    
    public function setIndex($index) 
    {
        $this->index = $index;
    }
    
    public function getCount() 
    {
        return $this->count;
    }
    
    public function setCount($count) 
    {
        $this->count = $count;
    }
    
    public function isFirst()
    {
        return $this->getIteration() == 1;
    }

    public function isLast()
    {
        return $this->getIteration() == $this->getCount();
    }

    public function isOdd()
    {
        return $this->getIteration() % 2 == 1;
    }
    
    public function isEven()
    {
        return $this->getIteration() % 2 == 0;
    }
    
    // ArrayAccess ------------------------------------------------------------
    
    public function offsetGet($offset)
    {
        switch (strtolower($offset)) {
            case 'index':
                return $this->getIndex();
            case 'iteration':
                return $this->getIteration();
            case 'count':
                return $this->getCount();
            case 'first':
                return $this->isFirst();
            case 'last':
                return $this->isLast();
            case 'even':
                return $this->isEven();
            case 'odd':
                return $this->isOdd();
            default:
                throw new Adept_Exception_IllegalArgument();
        }
    }
    
    public function offsetSet($offset, $value)
    {
        throw new Adept_Exception_UnsupportedOperation();
    }
    
    public function offsetUnset($offset)
    {
        throw new Adept_Exception_UnsupportedOperation();
    }
    
    public function offsetExists($offset)
    {
        throw new Adept_Exception_UnsupportedOperation();
    }

}
