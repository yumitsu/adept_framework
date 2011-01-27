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

class Adept_StateStorage
{

    /**
     * @var Adept_StateStorage_Adapter
     */
    protected $adapter = null;
    
    protected $views = array();
    
    public function getAdapter() 
    {
        return $this->adapter;
    }
    
    public function setAdapter($adapter) 
    {
        $this->adapter = $adapter;
    }

    /**
     * View storage lazy factory.
     *
     * @param string $viewId
     * @return Adept_StateStorage_View
     */
    public function getViewStorage($viewId)
    {
        if (!isset($this->views[$viewId])) {
            $this->views[$viewId] = new Adept_StateManager_View($this->getAdapter(), $viewId);
        }
        return $this->views[$viewId];
    }
    
}