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
 * @package    Adept_ClassKit
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

require_once('Adept/ClassKit/Delegate/Interface.php');

/**
 * Function delegate. 
 *
 */
class Adept_ClassKit_Delegate_Function implements Adept_ClassKit_Delegate_Interface 
{
    
    protected $function;
    protected $file;
    
    public function __construct($function, $file = null)    
    {
        $this->function = $function;
        $this->file = $file;    
    }
    
    public function invoke($args) 
    {
        if (!is_null($this->getFile())) {
            require_once($this->getFile());
        }
        return call_user_method_array($this->function, $args);
    }
    
    // Properties -------------------------------------------------------------
    
    public function getFunction()
    {
        return $this->function;
    }
    
    public function setFunction($function)
    {
        $this->function = $function;
    }
    
    public function getFile()
    {
        return $this->getFile();
    }
    
    public function setFile($file)
    {
        $this->file = $file;
    }
    
}

