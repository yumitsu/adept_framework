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
 * @package    Adept_Ajax
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Ajax_Command_Event extends Adept_Ajax_Command
{

    protected $element;
    protected $event;
    protected $evaluateElement;

    public function __construct($element = null, $event = null, $evaluateElement = false)
    {
        parent::__construct();
        $this->element = $element;
        $this->event = $event;
        $this->evaluateElement = $evaluateElement;
    }
    
    public function getElement() 
    {
        return $this->element;
    }
    
    public function setElement($element) 
    {
        $this->element = $element;
    }
    
    public function getEvent() 
    {
        return $this->event;
    }
    
    
    
    public function setEvent($event) 
    {
        $this->event = $event;
    }
    
    
    public function getEvaluateElement() 
    {
        return $this->evaluateElement;
    }
    
    public function setEvaluateElement($evaluateElement) 
    {
        $this->evaluateElement = $evaluateElement;
    }
    


}