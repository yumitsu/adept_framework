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

class Adept_Util_RangeIterator implements Iterator, Countable
{

    protected $current;
    protected $from;
    protected $to;
    protected $step;
    
    public function __construct($from, $to, $step = 1)
    {
        $this->from = $from;
        $this->to = $to;
        $this->step = $step;
    }

    public function rewind()
    {
        $this->current = $this->from;
    }
    
    public function next()
    {
        if (!$this->valid()) {
            return ;
        }
        $this->current += $this->step;
    }
    
    public function valid()
    {
        if ($this->step > 0) {
            return $this->current <= $this->to;
        } elseif ($this->step < 0) {
            return $this->current >= $this->to;
        } else {
            return false;
        }
    }
    
    public function key()
    {
        return $this->current;
    }
    
    public function current()
    {
        return $this->current;
    }
    
    public function count()
    {
        return abs($this->from - $this->to) / abs($this->step);
    }

}