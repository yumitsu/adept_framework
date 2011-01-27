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
 * @package    Adept_Exception
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */


class Adept_Exception_RuntimeExceptionHandler
{   
    private $exceptionClass;
    
    public function __construct($exceptionClass = 'Adept_Exception_Warning')
    {
        $this->exceptionClass = $exceptionClass;    
    }
     
    public function enable()
    {
        set_error_handler(array($this, "errorHandler"));
    }

    public function errorHandler($errno, $errstr, $file, $line)
    {
        $ec = $this->exceptionClass;
        throw new $ec("Runtime error: " . $errstr . "(" . $file . ":" . $line . ")");
    }

    public function disable()
    {
        restore_error_handler();
    }
}
