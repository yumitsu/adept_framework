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

class Adept_Component_Pager_Iterator implements Iterator, Countable
{

    /**
     * @var Adept_Component_Pager
     */
    protected $pager;

    /**
     * @var Adept_Component_Pager_Properties
     */
    protected $properties;
    
    public function __construct($pager, $properties)
    {
        $this->pager = $pager;
        $this->properties = $properties;
    }
    
    // Page numbers iterator --------------------------------------------------
    
    public function key()
    {
        return $this->properties->getCurrent();
    }
    
    public function current()
    {
        return $this->properties->getCurrent();
    }
    
    public function rewind()
    {
        $this->properties->setCurrent(1);
    }
    
    public function valid()
    {
        return $this->properties->getCurrent() <= $this->pager->getTotalPages();
    }
    
    public function next()
    {
        if ($this->properties->isCurrentSection()) {
            $this->properties->setCurrent($this->properties->getCurrent() + 1);
        } else {
            $this->properties->setCurrent($this->properties->getCurrent() + $this->pager->getPagesPerSection());
        }
    }

    public function count()
    {
        return $this->properties->getTotalPages();
    }   

}