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
 * @package    Adept_Renderer
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Renderer_Base extends Adept_Renderer_Abstract 
{
    
    public function __construct()
    {
    }
    
    public function handleRequest($component)
    {}

    public function renderBegin($component)
    {}

    public function renderChildren($component)
    {
        foreach ($component->getChildren() as $child) {
            $child->render();
        }
    }

    public function renderEnd($component)
    {}

    public function render($component)
    {
        $this->renderBegin($component);
        $this->renderChildren($component);
        $this->renderEnd($component);
    }

    public function getRequiredCss($component)
    {
        return array();
    }

    public function getRequiredJs($component)
    {
        return array();
    }
    
    // Convenience methods ----------------------------------------------------
    
        /**
     * Return current context instance.
     * 
     * @return Adept_Context
     */
    public function getContext()
    {
        return Adept_Context::getInstance();        
    }

    /**
     * Return current response writer 
     *
     * @return Adept_Response_Writer
     */
    public function getWriter()
    {
        return Adept_Context::getInstance()->getResponseWriter();
    }
    
    public function getLogger()
    {
        return Adept_Logger::getLogger(get_class($this));
    }
        
    /**
     * @return Adept_Request_Http
     */
    public function getRequest()
    {
        return Adept_Context::getInstance()->getRequest();
    }
    
    /**
     * @return Adept_Response_Http
     */
    public function getResponse()
    {
        return Adept_Context::getInstance()->getResponse();
    }
     
}