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

class Adept_Exception_Warning extends Adept_Exception 
{

    public function construct($message = "")
    {
        parent::__construct($message, 0, array());
    }
    
    /*
    public function toString()
    {
       require_once('Adept/Exception/Renderer/Text.php');
       $renderer = new Adept_Exception_Renderer_Text();
       return $renderer->render($this);
    }*/
    
}