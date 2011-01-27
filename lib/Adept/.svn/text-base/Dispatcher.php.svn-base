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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Dispatcher
{
    protected $controller;
    protected $rountes = null;
    protected $defaultController = null;

    /**
     * Configure dispatcher
     *
     * @param Adept_Config $config
     */
    public function init($config)
    {
        $this->initRoutes();
    }
    
    public function initRoutes()
    { }
    
    public function dispatch($request, $response)
    {
        foreach ($this->rountes as $route) {
            if ($route->check($request)) {
                $route->apply($request);
                if (null !== $route->getController()) {
                    $request->setController($route->getController());
                } else {
                    $request->setController($this->getDefaultController());
                }
                return true;
            }
        }
        return false;
    }

    public function addRoute($route)
    {
        $this->rountes[] = $route;
        return $this;
    }

    public function addNewRoute($pattern, $controller, $params = array())
    {
        $this->addRoute(new Adept_Dispatcher_Route($pattern, $controller, $params));
        return $this;
    }

    public function getDefaultController()
    {
        return $this->controller;
    }

    public function setDefaultController($controller)
    {
        $this->controller = $controller;
    }

}