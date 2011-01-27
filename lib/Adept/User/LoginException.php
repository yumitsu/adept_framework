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
 * @package    Adept_User
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_User_LoginException extends Adept_Exception 
{
    const INVALID_LOGIN_OR_PASSWORD = 1;
    const NOT_ACTIVATED = 2;
    
    protected $status = self::INVALID_LOGIN_OR_PASSWORD;
    
    public function __construct($message, $status = self::INVALID_LOGIN_OR_PASSWORD)
    {
        parent::__construct($message, $status);
        $this->setStatus($status);
    }
    
    public function getStatus() 
    {
        return $this->status;
    }
    
    public function setStatus($status) 
    {
        $this->status = $status;
    }

}
