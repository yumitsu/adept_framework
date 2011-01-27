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
 * @package    Adept_Http
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Http_Url
{
    private $_protocol = '';
    private $_user = '';
    private $_password = '';
    private $_host = '';
    private $_port = '';
    private $_path = '';
    private $_anchor = '';
    private $_query_items = array();
    private $_path_elements = array();

    public function __construct($url = '')
    {
        if (!empty($url)) {
            if (!$this->isAbsolute($url)) {
                $this->resolveAbsolute($url);
            }
                $this->parse($url);
        }
    }

    static function isAbsolute($url)
    {
        return preg_match('/^[a-z0-9]+:\/\//i', $url);
    }

    protected function resolveAbsolute($nonAbsolute)
    {
        if(isset($_SERVER['HTTP_HOST']) && strlen($_SERVER['HTTP_HOST'])) {
            $this->setHost($_SERVER['HTTP_HOST']);
        } else {
            $this->setHost('localhost');
        }

        if(isset($_SERVER['SERVER_PORT']) && strlen($_SERVER['SERVER_PORT'])) {
            $this->setPort($_SERVER['SERVER_PORT']);
        }

        $this->parse($nonAbsolute);
    }

    /**
     * Возвращает текущий URL
     *@todo написать проверку на протокол (http/https)
     *@return Zend_Uri_Http
     */
    static function getCurrent()
    {
        $url = Zend_Uri::factory();

        if(isset($_SERVER['HTTP_HOST']) && strlen($_SERVER['HTTP_HOST'])) {
            $url->setHost($_SERVER['HTTP_HOST']);
        } else {
            $url->setHost('localhost');
        }

        if(isset($_SERVER['SERVER_PORT']) && strlen($_SERVER['SERVER_PORT'])) {
            $url->setPort($_SERVER['SERVER_PORT']);
        }

        $url->setPath($_SERVER['SCRIPT_NAME']);

        if(isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING'])) {
            $url->setQuery($_SERVER['QUERY_STRING']);
        }

        return $url;

        //echo Adept_Util_Varier::getHtml($_SERVER);
    }

    public function reset()
    {
        $this->_protocol = '';
        $this->_user = '';
        $this->_password = '';
        $this->_host = '';
        $this->_port = '';
        $this->_path = '';
        $this->_anchor = '';
        $this->_query_items = array();
        $this->_path_elements = array();
    }

    public function parse($str)
    {
        if (empty($str))    {
            throw new Adept_Exception('Empty string given');
        }

        if (!$parts = @parse_url($str)) {
            throw new Adept_Exception('Url parsing error');
        }

        foreach ($parts as $key => $value) {
            switch ($key) {
                case 'scheme':
                    $this->setProtocol($value);
                    break;
                case 'user':
                    $this->setUser($value);
                    break;
                case 'host':
                    $this->setHost($value);
                    break;
                case 'port':
                    $this->setPort($value);
                    break;
                case 'pass':
                    $this->setPassword($value);
                    break;
                case 'path':
                    $this->setPath($value);
                    break;
                case 'query':
                    $this->setQueryString($value);
                    break;
                case 'fragment':
                    $this->setAnchor($value);
                    break;
            }
        }
    }

    public function getProtocol()
    {
        return $this->_protocol;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    function getHost()
    {
        return $this->_host;
    }

    function getPath()
    {
        return $this->_path;
    }

    function getPathElement($index)
    {
        return isset($this->_path_elements[$index]) ? $this->_path_elements[$index] : null;
    }

    function getPathElements()
    {
        return $this->_path_elements;
    }

    function getAnchor()
    {
        return $this->_anchor;
    }

    function getQueryItems()
    {
        return $this->_query_items;
    }

    function setProtocol($protocol)
    {
        $this->_protocol = $protocol;
    }

    function setUser($user)
    {
        $this->_user = $user;
    }

    function setPassword($password)
    {
        $this->_password = $password;
    }

    function setHost($host)
    {
        $this->_host = $host;
    }

    function setPort($port)
    {
        $this->_port = $port;
    }

    function setPath($path)
    {
        $this->_path = $path;
        $elements = explode('/', $this->_path);
        $this->_path_elements = array();
        foreach ($elements as $element) {
            if (trim($element) != '') {
                $this->_path_elements[] = $element;
            }
        }
    }

    function setAnchor($anchor)
    {
        $this->_anchor = $anchor;
    }

    function setQueryString($query_string)
    {
        $this->_query_items = $this->_parseQueryString($query_string);
    }

    function _parseQueryString($query_string)
    {
        $query_string = rawurldecode($query_string);
        parse_str($query_string, $arr);
        foreach ($arr as $key => $value) {
            if (!is_array($value)) {
                $arr[$key] = rawurldecode($value);
            }
        }
        return $arr;
    }

    /**
     * @todo Add parts description
     *
     * @param array $parts 
     * @return string Url
     */
    public function toString($parts = array('protocol', 'user', 'password', 'host', 'port', 'path', 'query', 'anchor'))
    {
        $result = '';
        if (in_array('protocol', $parts)) {
            $result .= !empty($this->_protocol) ? $this->_protocol . '://' : '';
        }

        if (in_array('user', $parts)) {
            $result .= $this->_user;
            if(in_array('password', $parts))
            $result .= (!empty($this->_password) ? ':' : '') . $this->_password
                    . (!empty($this->_user) ? '@' : '');
        }

        if(in_array('host', $parts)) {
            $result .= $this->_host;

            if(in_array('port', $parts))
            $result .= (empty($this->_port) ||    $this->_port == '80') ? '' : ':' . $this->_port;
        } else {
            $result = '';
        }

        if(in_array('path', $parts)) {
            $result .= $this->_path;
        }

        if(in_array('query', $parts)) {
            $query_result = $this->getQueryString();
            $result .= !empty($query_result) ? '?' . $query_result : '';
        }

        if(in_array('anchor', $parts)) {
            $result .= !empty($this->_anchor) ? '#' . $this->_anchor : '';
        }

        return $result;
    }

    function getQueryString()
    {
        $query_string = '';
        $query_items = array();
        $flat = array();

        Adept_Util_Array::flat($this->_query_items, $flat);

        ksort($flat);

        foreach ($flat as $key => $value) {
            if ($value != '' || is_null($value)) {
                $query_items[] = $key . '=' . $value;
            } else {
                $query_items[] = $key;
            }
        }

        if ($query_items) {
            $query_string = implode('&', $query_items);
        }
        return $query_string;
    }

    function clearQueryItems()
    {
        $this->_query_items = array();
    }

    public function isValid()
    {
        if(!$this->getHost()) {
            return false;
        }
        return true;
    }

}
