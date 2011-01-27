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
 * @package    Adept_Session
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Session_Abstract extends Adept_Access 
{ 

    /**
     * Namespaces map.
     * 
     * @var array
     */
    private $_namespaces = array();
    
    /**
     * Creates session namespace.
     * 
     * Namespace is used as session wrapper and helps to avoid conflicts.
     * 
     * @see Adept_Session_Namespace
     * 
     * @param string $namespace
     * @return Adept_Session_Namespace
     */
    public function getNamespace($namespace)
    {
        $namespace = (string) $namespace;
    	if (!isset($this->_namespaces[$namespace])) {
            $this->_namespaces[$namespace] = new Adept_Session_Namespace($this, $namespace); 	     
    	}
    	return $this->_namespaces[$namespace];
    }
    
    public function getNamespacePrefix()
    {
        return '';
    }
    
}
