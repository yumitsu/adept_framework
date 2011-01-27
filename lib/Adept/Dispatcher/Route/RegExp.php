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

class Adept_Dispatcher_Route_RegExp implements Adept_Dispatcher_Route_Interface 
{

    /**
     * RegExp url pattern
     *
     * @var string
     */
    protected $pattern;

    protected $parameters = array();

    /**
     * Reverse url pattern for aseemblying.
     * 
     * @var string
     */
    protected $reverse = null;

    public function __construct($pattern = null, $parameters = array(), $reverse = null)
    {
        $this->pattern = $pattern;
        $this->parameters = $parameters;
        $this->reverse = $reverse;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function match($url)
    {
        $matches = array();
        
        if (!preg_match("~^{$this->pattern}$~", $url, $matches)) {
            return false;
        }

        foreach ($this->parameters as $key => $param) {
            for ($i = 0; $i < count($matches); $i++) {
                $param = str_replace('$' . $i, $matches[$i], $param);
            }
            Adept_Context::getInstance()->getRequest()->set($key, $param);
        }        

        return true;
    }

    /**
     * @param array $params
     * @return string
     * 
     * @throws Adept_Exception_IllegalState
     */
    public function assembly($params = array())
    {
        if ($this->reverse == null) {
            throw new Adept_Exception_IllegalState('Cannot assembly url because reverse pattern not defiend');
        }
        $result = vsprintf($this->reverse, $params);
        return $result;
    }
    
    // Properties --------------------------------------------------------------
    
    /**
     * @param string $name
     * @param string $value
     */
    public function setParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }
    
    /**
     * @param string $name
     * @return string
     */
    public function getParameter($name)
    {
        return isset($this->parameters[$name]) ? $this->parameters[$name] : null;
    }
    
    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @return string
     */
    public function getReverse()
    {
        return $this->reverse;
    }

    /**
     * @param string $reverse
     */
    public function setReverse($reverse)
    {
        $this->reverse = $reverse;
    }

}