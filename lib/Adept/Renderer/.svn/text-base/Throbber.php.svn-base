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

class Adept_Renderer_Throbber extends Adept_Renderer_AbstractControl
{

    /**
     * @param Adept_Component_Throbber $component
     */
    public function renderBegin($component)
    {
        $cssClass = $component->getCssClass() ? $component->getCssClass() : 'a-throbber'; 
        $cssStyle = $component->getCssStyle() ? $component->getCssStyle() 
            : 'position: absolute; width: 16px; height: 16px; z-index: 1001; ';
        
        $writer = $this->getWriter();
        $writer->writeTag('div', array(
           'id' => $component->getClientId(),
           'class' => $cssClass,
           'style' => $cssStyle
        ));
    }
    
    public function renderChildren($component)
    {
        parent::renderChildren($component);        
    }
    
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeClosedTag('div');
        $writer->writeScriptBegin();
        $this->renderClientController($component->getClientId(), 'Adept.Controller.Throbber', array(), array());
        $writer->writeScriptEnd();
    }
    
    public function getRequiredJs()
    {
        return array('Adept/Controller.js', 'Adept/Controller/Throbber.js');
    }
        
}
