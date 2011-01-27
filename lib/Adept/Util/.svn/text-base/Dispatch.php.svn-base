<?php

class Adept_Util_Dispatch
{
    static public function getRoute($routeName, $params = array())
    {
        if (!is_array($params)) {
            $params = array($params);
        }
        $routes = Adept_Dispatcher_Route_Registry::getInstance()->getRoutes();
        return isset($routes[$routeName]) ? $routes[$routeName]->assembly($params) : null;
    }
    
    static public function getCurrentRoute()
    {
        return Adept_Dispatcher_Route_Registry::getInstance()->getCurrentRoute();
    }
    
    static public function getCurrentRouteName()
    {
        return Adept_Dispatcher_Route_Registry::getInstance()->getCurrentRouteName();
    }
}