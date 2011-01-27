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
 * @package    Adept_Logger
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Logger_Record 
{

    protected $name;
    protected $timeStamp;
    protected $message;
    protected $type;
    protected $parameters = array();
    
    public function __construct($name, $message, $type = Adept_Logger::LOG_INFO, $parameters = array(), $timeStamp = null)
    {
        $this->name = $name;
        $this->message = $message;
        $this->timeStamp = ($timeStamp == null) ? time() : $timeStamp;
        $this->type = $type;
        $this->parameters = $parameters;
    }
    
    public function addParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }
    
    // Getters-setters {{
    
    public function getName() 
    {
        return $this->name;
    }
    
    public function setName($name) 
    {
        $this->name = $name;
    }
    
    public function getTimeStamp() 
    {
        return $this->timeStamp;
    }
    
    public function setTimeStamp($timeStamp) 
    {
        $this->timeStamp = $timeStamp;
    }
    
    public function getMessage() 
    {
        return $this->message;
    }
    
    public function setMessage($message) 
    {
        $this->message = $message;
    }

    public function getType() 
    {
        return $this->type;
    }
    
    public function setType($type) 
    {
        $this->type = $type;
    }
    
    public function getParameters() 
    {
        return $this->parameters;
    }
    
    public function setParameters($parameters) 
    {
        $this->parameters = $parameters;
    }
    
    // }}

}
