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
 * @package    Adept_Request
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

abstract class Adept_Request_Abstract
{

    protected $action = null;

    protected $controller = null;

    protected $parameters = array();

    /**
     * Return request parameter if exists otherwise null
     * @param string $key
     * @return mixed
     */
    public function getParameter($key)
    {
        return isset($this->parameters[$key]) ? $this->parameters[$key] : null;
    }

    public function get($key)
    {
        return $this->getParameter($key);
    }

    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    public function hasParameter($key)
    {
        return isset($this->parameters[$key]);
    }

    public function has($key)
    {
        return $this->hasParameter($key);
    }

    public function getAction() 
    {
        return $this->get('action');
    }
    
    public function setAction($action) 
    {
        $this->setParameter('action', $action);
    }
    
    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }
    
}
