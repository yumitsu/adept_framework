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
 * @package    Adept_ClassKit
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_ClassKit_Proxy 
{
        
    /**
     * Delegate object
     *
     * @var mixed
     */
    protected $_delegate = null;
    
    /**
     * @param object $delegate
     */
    public function __construct($delegate = null)
    {
        if ($delegate) {
            $this->setProxyDelegate($delegate);
        }
    }
        
    public function __call($method, $args = array()) 
    {
        if (null == $this->_delegate) {
            throw new Adept_Exception_NullPointer();
        }
        
        if (method_exists($this->_delegate, $method)) {
            return call_user_func_array(array($this->_delegate, $method), $args);
        } else {
            if (method_exists($this->_delegate, '__call')) {
                return $this->_delegate->__call($method, $args);
            } else {
                throw new Adept_Exception("Cannot call undefined method '{$method}'"
                    . " of delegate class " . get_class($this->_delegate));    
            }
        }
    }

    public function __get($attr) 
    {
        if (null == $this->_delegate) {
            throw new Adept_Exception_NullPointer();
        }
        return $this->_delegate->$attr;
    }
    
    public function __set($attr, $val) 
    {
        if (null == $this->_delegate) {
            throw new Adept_Exception_NullPointer();
        }
        $this->_delegate->$attr = $val;
    }
    
    // Properties -------------------------------------------------------------
    
    public function getProxyDelegate()
    {
        return $this->_delegate;
    }
    
    public function setProxyDelegate($delegate)
    {
        $this->_delegate = $delegate;
    }
    
}
