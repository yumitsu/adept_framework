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

abstract class Adept_ClassKit_LazyProxy extends Adept_ClassKit_Proxy 
{
    
    /**
     * Delegate resolved bool flag.
     *
     * @var bool True if delegate object already resolved, false otherwise. 
     */
    protected $_delegateResolved; 
    
    abstract protected function _createDelegateObject();
 
    public function _resolveDelegate() 
    {
        if ($this->_delegateResolved) {
            return $this->_delegate;
        }
        $this->_delegate = $this->_createDelegateObject();
        $this->_delegateResolved = true;
        return $this->_delegate;
    }

    public function __call($method, $args = array()) 
    {
        $this->_resolveDelegate();
        parent::__call($method, $args);
    }

    public function __get($attr) 
    {
        $this->_resolveDelegate();
        parent::__get($attr);
    }
    
    public function __set($attr, $val) 
    {
        $this->_resolveDelegate();
        parent::__set($attr, $val);
    }
    
    public function getProxyDelegate()
    {
        $this->_resolveDelegate();
        return $this->_delegate;
    }
       
}
