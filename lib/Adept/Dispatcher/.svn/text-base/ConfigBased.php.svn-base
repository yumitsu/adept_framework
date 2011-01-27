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
 * @package    Adept_Dispatcher
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Dispatcher_ConfigBased extends Adept_Dispatcher 
{

    protected $config;
    
    public function init($config)
    {
        $this->config = $config;
        $this->setDefaultController($config->get('defaultController')->get('class'));
        $this->initRoutes();
    }
    
    public function initRoutes()
    {
        foreach ($this->config->getAsList('route') as $route) {
            
            if ($route->get('parameter')->get('controller') !== null) {
                $controller = $route->get('parameter')->get('controller');
            } else {
                $controller = $this->getDefaultController();
            }
            
            $routePattern = $route->get('pattern');
            if ($routePattern === null) {
                throw new Adept_Exception_NullPointer('Route pattern parameter not defined. See configuration. ');
            }

            $this->addNewRoute($routePattern, $controller, $route->get('parameter')->toArray());
        }
    }
    
}