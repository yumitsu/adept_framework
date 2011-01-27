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

class Adept_Dispatcher_Route 
{

    protected $baseUrl = '';
    protected $controller = '';
    protected $pattern = null;
    protected $subdomain = '';
    
    /**
     * @var array
     */
    protected $params = array();
    
    public function __construct($pattern = '', $controller = '', $params = array(), $baseUrl = '') 
    {
        if (strpos($pattern, ':')) {
            list($this->subdomain, $this->pattern) = explode(':', $pattern);
            
        } else {
            $this->pattern = $pattern;    
        }
        
        $this->controller = $controller;
        $this->params = $params;
        $this->baseUrl = $baseUrl;
    }

    public function apply($request) 
    {
        if (!$this->check($request)) {
            return false;
        }
        $path = $this->getNormalizedPath($request);
        $subdomain = $this->getNormalizedSubdomain();
        $matches = $this->matchParams($path, $subdomain);
        foreach ($this->params as $key => $param) {
            for ($i = 0; $i < count($matches); $i++) {
                $param = str_replace('$' . $i, $matches[$i], $param);
            }
            $request->setParameter($key, $param);
        }
    }

    private function getNormalizedSubdomain()
    {
        $host = $_SERVER['HTTP_HOST'];
        $level = explode('.', $host);
        if ($level[0] == 'www') {
            array_shift($level);
        }
        
        if (count($level) >= 3) {
            return $level[count($level)-3];
        } else {
            return '';
        }
    }

    private function getNormalizedPath($request) 
    {
        $url = $request->getUrl();
        
        $adeptUrl = new Adept_Http_Url($url->getUri());
        
        $path = "/" . implode("/", $adeptUrl->getPathElements());
        return $path;
    }

    public function check(Adept_Request_Http $request) 
    {
        $path = $this->getNormalizedPath($request);
        $subdomain = $this->getNormalizedSubdomain();
        
        $matches = array();
        
        if (preg_match("~^{$this->pattern}$~", $path, $matches)) {
            if (!$this->subdomain ||
                (isset($this->subdomain) && preg_match("~^{$this->subdomain}$~", $subdomain))) {
                return true; 
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // @todo: возможно убрать preg_match для сабдоменов, там он вобщем не нужен вообще
    protected function matchParams($urlString, $subdomain) 
    {
        $matches = array();
        $matches2 = array();
        
        if (preg_match("~^{$this->pattern}$~", $urlString, $matches)) {
            if (isset($this->subdomain) && preg_match("~^{$this->subdomain}$~", $subdomain, $matches2)) {
                $matches = array_merge($matches, $matches2);
            }
            return $matches;
        } else {
            return false;
        }
    }

    public function getController() 
    {
        return $this->controller;
    }

    public function setController($controller) 
    {
        $this->controller = $controller;
    }

    public function getPattern() 
    {
        return $this->pattern;
    }

    public function setPattern($pattern) 
    {
        $this->pattern = $pattern;
    }

    public function getBaseUrl() 
    {
        return $this->baseUrl;
    }

    public function setBaseUrl($baseUrl) 
    {
        $this->baseUrl = $baseUrl;
    }

}
