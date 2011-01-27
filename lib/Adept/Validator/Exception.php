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
 * @package    Adept_Validator
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Validator_Exception extends Adept_Exception 
{
    protected $type;    

    public function __construct($message, $type = Adept_Message::ERROR, $params = array()) 
    {
        parent::__construct($message, 0, $params);
        $this->setType($type);
    }    
    
    public function getLocalizedMessage()
    {
        $message = Adept_Util_String::fillPlaces($this->message, $this->params);
        return $message;
    }
    
    public function getType() 
    {
        return $this->type;
    }
    
    public function setType($type) 
    {
        $this->type = $type;
    }
    
}
