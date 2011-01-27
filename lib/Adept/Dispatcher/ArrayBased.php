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

abstract class Adept_Dispatcher_ArrayBased extends Adept_Dispatcher
{
    protected $defaultController;

    public function initRoutes()
    {
        $routes = $this->defineRoutes();
        foreach ($routes as $routePattern => $routeOptions) {
            $controller = null;
            if (isset($routeOptions['controller'])) {
                $controller = $routeOptions['controller'];
                unset($routeOptions['controller']);
            } else {
                $controller = $this->defaultController;
            }
            $this->addNewRoute($routePattern, $controller, $routeOptions);
        }
    }

    public function dispatch($request, $response)
    {
        $this->initRoutes();
        return parent::dispatch($request, $response);   
    }
    
    abstract function defineRoutes();

    public function getDefaultController()
    {
        return $this->defaultController;
    }

    public function setDefaultController($defaultController)
    {
        $this->defaultController = $defaultController;
    }

}
