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
 * @package    Adept_Aop
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Aop_SelfInvokableMethod
{
    private $refMethod;
    private $adviceObject;
    private $order = 0;
    
    public function __construct($refMethod, $adviceObject)
    {
        $this->refMethod = $refMethod;
        $this->adviceObject = $adviceObject;
    }
    
    public function setOrder($order)
    {
        $this->order = $order;
    }
    
    public function getOrder()
    {
        return $this->order;
    }

    public function getAdviceObject()
    {
        return $this->adviceObject;
    }
    
    public function invoke()
    {
        return $this->refMethod->invoke($this->adviceObject);
    }
    
}