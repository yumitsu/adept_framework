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
 * @package    Adept_Test
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Test_WebRunner_Dispatcher
{    
    public function dispatchRequest()
    {
        if(!isset($_POST['action']))
        {
            $_POST['action'] = 'list';
        }
        
        switch($_POST['action'])
        {
            case 'list':
                $controller = new Adept_Test_WebRunner_Controller_SuiteList();
                $controller->execute();
                break;
                
            case 'run':
                $controller = new Adept_Test_WebRunner_Controller_ShowResult();
                $controller->execute();
                break;
        }
    }            
}