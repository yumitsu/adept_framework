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
 * @package    Adept_Component
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Component_Message_Balloon extends Adept_Component_Message_FieldError 
{
    public function hasRenderer()
    {
    	return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Message_Balloon';
    }         
    
    
    
    public function getTitle() 
    {
        return $this->getProperty('title');
    }
    
    public function setTitle($title)
    {
        $this->setProperty('title', $title);
    }
    
    public function getOffsetLeft() 
    {
        return $this->getProperty('offsetLeft', 0);
    }
    
    public function setOffsetLeft($offsetLeft)
    {
        $this->setProperty('offsetLeft', $offsetLeft);
    }
    
    public function getOffsetTop() 
    {
        return $this->getProperty('offsetTop',0);
    }
    
    public function setOffsetTop($offsetTop)
    {
        $this->setProperty('offsetTop', $offsetTop);
    }
    
}