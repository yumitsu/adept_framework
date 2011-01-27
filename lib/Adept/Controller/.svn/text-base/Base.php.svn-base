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
 * @package    Adept_Controller
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

/**
 * Base controller contains some useful methods. 
 */
class Adept_Controller_Base 
{

    /**
     * @return Adept_Context
     */
    public function getContext()
    {
        return Adept_Context::getInstance();
    }
    
    /**
     * @return Adept_Request_Http
     */
    public function getRequest()
    {
        return $this->getContext()->getRequest();    
    }
    
    /**
     * @return Adept_Response_Http
     */
    public function getResponse()
    {
        return $this->getContext()->getResponse();
    }
    
    /**
     * Reutrn HTTP session instance
     * 
     * @return Adept_Session_Http
     */
    public function getHttpSession()
    {
        return $this->getContext()->getSession();
    }
    
    /**
     * Returns current view session namespace.
     *
     * @return Adept_Session_Namespace
     */
    public function getViewSession()
    {
    	return $this->getContext()->getRootView()->getViewSession();
    }
    
    /**
     * @return Adept_Application
     */
    public function getApplication()
    {
        return $this->getContext()->getApplication();
    }    
    
    /**
     * Returns Message Set.
     * 
     * @return Adept_MessageSet
     */
    public function getMessageSet()
    {
    	return $this->getContext()->getMessageSet();
    }
    
    /**
     * @return Adept_Component_RootView
     */
    public function getRootView()
    {
    	return $this->getContext()->getRootView();
    }
    
        
}
