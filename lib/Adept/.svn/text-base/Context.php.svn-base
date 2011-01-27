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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Context extends Adept_Access
{

    private $ajaxChannel;
    
    private $application;
    private $messageSet;
    private $renderKit;
    private $request;
    private $response;
    private $responseWriter;
    private $session;
    private $stateStorage = null;
    private $root;
    private $user;
    private $acl;
    
    private $viewSession;
    
    private $attributes = array();
    
    // Context singleton ------------------------------------------------------
    
    private static $instance = null;
    private static $instanceClass = 'Adept_Context';

    protected function __construct()
    { 
        
    }

    /**
     * Creates context singleton. 
     * 
     * @return Adept_Context
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            $class = self::$instanceClass;
            self::$instance = new $class();
        }
        return self::$instance;
    }
    
    public static function setInstanceClass($instanceClass)
    {
        if (self::$instance !== null) {
            throw new Adept_Exception_IllegalState('Context already created');
        }
        self::$instanceClass = $instanceClass;
    }

    // Properties -------------------------------------------------------------
    
    /**
     * Returns ajax channel service class.
     *
     * @return Adept_Ajax_Channel
     */
    public function getAjaxChannel() 
    {
        if ($this->ajaxChannel == null) {
            $this->ajaxChannel = new Adept_Ajax_Channel();
        }
        return $this->ajaxChannel;
    }
    
    public function setAjaxChannel($ajaxChannel) 
    {
        $this->ajaxChannel = $ajaxChannel;
    }
    
    /**
     * @return Adept_Application
     */
    public function getApplication() 
    {
        return $this->application;
    }
    
    /**
     * Set application reference
     *
     * @param Adept_Application $application
     */
    public function setApplication($application) 
    {
        $this->application = $application;
    }

    /**
     * Returns message set object instance.
     *
     * @return Adept_MessageSet
     */
    public function getMessageSet() 
    {
        if ($this->messageSet == null) {
            $this->messageSet = new Adept_MessageSet();
        }
        return $this->messageSet;
    }
    
    public function setMessageSet($messageSet) 
    {
        $this->messageSet = $messageSet;
    }
    
    /**
     * Returns {@link Adept_RenderKit} instance. 
     *
     * @return Adept_RenderKit
     */
    public function getRenderKit() 
    {
        if ($this->renderKit === null) {
            $this->renderKit = new Adept_RenderKit();
        }
        return $this->renderKit;
    }
    
    public function setRenderKit($renderKit) 
    {
        $this->renderKit = $renderKit;
    }
    
    /**
     * Return request object instance
     *
     * @return Adept_Request_Http
     */
    public function getRequest()
    {
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        $this->attributes['_request'] = $request;
    }

    /**
     * Return response object
     *
     * @return Adept_Response_Http
     */
    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse($response)
    {
        $this->response = $response;
        $this->attributes['_response'] = $response;
    }

    /**
     * Return response writer instance.
     *
     * @return Adept_Response_Writer
     */
    public function getResponseWriter() 
    {
        return $this->responseWriter;
    }
    
    public function setResponseWriter($responseWriter) 
    {
        $this->responseWriter = $responseWriter;
    }
    
    /**
     * @deprecated Use getRootView instead.
     * 
     * @return Adept_Component_View_RootView
     */
    public function getRoot()
    {
        return $this->getRootView();
    }
    
    /**
     * @deprecated Use setRootView instead 
     * 
     * @param Apept_Component_RootView $root
     */
    public function setRoot($root)
    {
        $this->setRootView($root);
    }

    /**
     * @return Adept_Component_RootView
     */
    public function getRootView()
    {
        return $this->root;
    }

    public function setRootView($rootView)
    {
        $this->root = $rootView;
        $this->attributes['_root'] = $rootView; // depricated
        $this->attributes['_rootView'] = $rootView; 
    }

    /**
     * Returns HTTP-session object.
     *
     * @return Adept_Session_Http
     */    
    public function getHttpSession()
    {
    	return $this->getSession();
    }
    
    /**
     * Return session object instance
     *
     * @return Adept_Session_Abstract
     */
    public function getSession()
    {
        return $this->session;
    }

    public function setSession($session)
    {
        $this->session = $session;
        $this->attributes['_session'] = $session;
    }
    
    public function getStateStorage() 
    {
        if (null == $this->stateStorage) {
            $this->stateStorage = new Adept_StateStorage();
        }
        return $this->stateStorage;
    }
    
    public function setStateStorage($stateStorage) 
    {
        $this->stateStorage = $stateStorage;
    }

    /**
     * Return ACL object
     *
     * @return Adept_Acl
     */
    public function getAcl()
    {
        return $this->acl;
    }

    public function setAcl($acl)
    {
        $this->acl = $acl;
        $this->attributes['_acl'] = $acl;
    }

    /**
     * @return Adept_User_IUser
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Adept_User_IUser $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        $this->attributes['_user'] = $user;
    }
    
    // Access ------------------------------------------------------------------

    public function get($key)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : null;
    }

    public function set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function has($key)
    {
        return isset($this->attributes[$key]);
    }

    public function remove($key)
    {
        unset($this->attributes[$key]);
    }
    
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }
    
    public function getAttribute($key)
    {
        return $this->get($key);
    }

    public function setAttribute($key, $value)
    {
        $this->set($key, $value);
    }

    public function hasAttribute($key)
    {
        return $this->has($key);
    }

    public function removeAttribute($key)
    {
        $this->remove($key);
    }

}
