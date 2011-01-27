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
class Adept_Ajax_Command_Invoke extends Adept_Ajax_Command 
{

    protected $controllerId;
    protected $methodName;
    protected $params;
    
    public function __construct($controllerId = '' , $methodName = '' , $params = array())
    {
        parent::__construct();
        
        $this->controllerId = $controllerId;
        $this->methodName = $methodName;
        $this->params = $params;
        
    }
    
    public function getControllerId() 
    {
       return $this->controllerId;
    }
    
    public function setControllerId($controllerId) 
    {
       $this->controllerId =  $controllerId;
    }
    
    public function getMethodName() 
    {
       return $this->methodName;
    }
    
    public function setMethodName($methodName) 
    {
       $this->methodName =  $methodName;
    }
    
    public function getParams() 
    {
       return $this->params;
    }
    
    public function setParams($params) 
    {
       $this->params =  $params;
    }
    
}

