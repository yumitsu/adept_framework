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
 * @package    Adept_StateManager
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_StateManager_View
{

    /**
     * @var Adept_StateStorage_Adapter_Abstract
     */
    protected $adapter;
    
    protected $viewId;
    
    protected $loadedStates = null;
    
    public function __construct($adapter, $viewId)
    {
        $this->adapter = $adapter;
        $this->viewId = $viewId;
    }

    /**
     * @return Adept_StateStorage_Adapter_Abstract
     */
    public function getAdapter() 
    {
        return $this->adapter;
    }
    
    /**
     * @param Adept_StateStorage_Adapter_Abstract $adapter
     */
    public function setAdapter($adapter) 
    {
        $this->adapter = $adapter;
    }
    
    public function load($id)
    {
        $session = Adept_Context::getInstance()->getSession();
        $key = '_viewStorage_' . $this->viewId . '_' . $id;
        return $session->get($key);
    }
    
    public function save($id, $state)
    {
        $session = Adept_Context::getInstance()->getSession();
        $key = '_viewStorage_' . $this->viewId . '_' . $id;
        return $session->set($key, $state);
    }
    
}