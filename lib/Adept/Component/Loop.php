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

class Adept_Component_Loop extends Adept_Component_List
{

    public function createCycleIterator()
    {
        return new Adept_Component_List_Iterator($this, 
            new Adept_Util_RangeIterator($this->getFrom(), $this->getTo(), $this->getStep()));
    }

    // ------------------------------------------------------------------------

    public function getFrom()
    {
        return $this->getProperty('from');
    }

    public function setFrom($from)
    {
        $this->setProperty('from', $from);
    }

    public function getTo()
    {
        return $this->getProperty('to');
    }

    public function setTo($to)
    {
        $this->setProperty('to', $to);
    }

    public function getStep()
    {
        return $this->getProperty('step', 1);
    }

    public function setStep($step)
    {
        $this->setProperty('step', $step);
    }

}
