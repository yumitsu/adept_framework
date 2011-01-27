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

class Adept_Request_Http extends Adept_Request_Abstract implements ArrayAccess
{

    static protected $instance;

    protected $url;
    protected $request = array();

    public function __construct()
    {
        $this->request = array_merge($_GET, $_POST);
        if (get_magic_quotes_gpc()) {
            $this->request = $this->_stripHttpSlashes($this->request);
        }

        if (count($_FILES)) {
            $fileParser = new Adept_Request_FileParser();
            $this->request = array_merge($this->request, $fileParser->parseFiles($_FILES));
        }
        $encoding = Adept_Context::getInstance()->getApplication()->getEncoding();
        if ($this->isAjax() && $encoding) {
            $this->convertCharset('UTF-8', $encoding);
        }
    }

    public function convertCharset($inCharset, $outCharset)
    {
        $this->request = $this->_convertArray($inCharset, $outCharset, $this->request);
    }

    protected function _convertArray($inCharset, $outCharset, $values)
    {
        $result = array();
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->_convertArray($inCharset, $outCharset, $value);
            } else {
                $result[$key] = @iconv($inCharset, $outCharset, $value);
            }
        }
        return $result;
    }

    protected function _stripHttpSlashes($data, $result = array())
    {
        foreach($data as $key => $value) {
            $result[$key] = (is_array($value)) ?
            $this->_stripHttpSlashes($value) : stripcslashes($value);
        }
        return $result;
    }

    public function getValue($name)
    {
        return isset($this->request[$name]) ? $this->request[$name] : null;
    }

    public function hasValue($name)
    {
        return isset($this->request[$name]);
    }

    /**
     * @return Zend_Uri_Http
     */
    public function getUrl()
    {
        if(is_null($this->url)) {
            $this->url = Zend_Uri::factory(isset($_SERVER['REQUEST_URI']) ? 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] : $_SERVER['HTTP_HOST']);
        }
        return $this->url;
    }
    
    /**
     * @param mixed $url Zend_Uri_Http or string 
     */
    public function setUrl($url)
    {
        if (is_string($url)) {
            $this->url = Zend_Uri::factory($url);
        } elseif ($url instanceof Zend_Uri_Http) {
            $this->url = clone $url;
        }
    }

    public function getValues()
    {
        return $this->request;
    }

    public function hasCookie($name)
    {
        return isset($_COOKIE[$name]) && !is_null($_COOKIE[$name]);
    }

    public function getCookie($name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    /**
     * Return some request parameter or value
     *
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        switch (true) {
            case $this->hasParameter($name):
                return $this->getParameter($name);
            case $this->hasValue($name):
                return $this->getValue($name);
            case $this->hasCookie($name):
                return $this->getCookie($name);
            case isset($_SERVER[$name]):
                return $_SERVER[$name];
            case isset($_ENV[$name]):
                return $_ENV[$name];
        }
        return null;
    }

    /**
     * Return some request parameter or value
     *
     * @param string $name
     * @return mixed
     */
    public function has($name)
    {
        return
            $this->hasParameter($name)
            || $this->hasValue($name)
            || $this->hasCookie($name)
            || isset($_SERVER[$name])
            || isset($_ENV[$name]);
    }

    public function set($key, $value)
    {
        $this->setParameter($key, $value);
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Used for get request parameter via array access
     *
     * Example:
     * <pre>
     *     echo $request['foo']; // == $request->get('foo')
     * </pre>
     *
     * @param string $offset Parameter name
     * @return mixed Value of parameter
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Used for set request parameter via array access
     *
     * Example:
     * <pre>
     *     $request['foo'] = 'bar'; // == $request->set('foo', 'bar')
     * </pre>
     *
     * @param string $offset Parameter name
     * @param string $value Parameter value
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * Used for unset request parameter via array access
     *
     * Example:
     * <pre>
     *     unset($request['foo']); // $request->set('foo', null)
     * </pre>
     *
     * @param string $offset Parameter name
     * @param string $value Parameter value
     */
    public function offsetUnset($offset)
    {
        $this->set($offset, null);
    }

    /**
     * Used for unset request parameter via array access
     *
     * Example:
     * <pre>
     *     if (isset($request['foo']))... ; // if ($request->get('foo') != null) { ... }
     * </pre>
     *
     * @param string $offset Parameter name
     */
    public function offsetExists($offset)
    {
        return !is_null($this->get($offset));
    }

    public function isAjax()
    {
        if ($this->hasValue('ajax') && ($this->getValue('ajax') == 1)) {
            return true;
        }
        return false;
    }
    
    /**
     * Returns true if request method is POST.
     *
     * @return bool
     */
    public function isPost()
    {
        return (bool) $_POST;
    }

    public function getReferer()
    {
        return (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : false;
    }

    public function getIp()
    {
        return (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : false;
    }

}
