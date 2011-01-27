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

class Adept_Renderer_Message_Balloon extends Adept_Renderer_AbstractControl 
{
     /**
     * @param Adept_Component_Message_Balloon $component
     */
    public function renderBegin($component)
    {
        
        
       $writer = $this->getWriter();
       $writer->writeTag('div',
                array(
                    'id' => $component->getClientId(),
                    'class' => 'a-balloon' //. " " . $component->getCssClass(),
//                    'style' => $component->getCssStyle()
                )
       
       
       );
       
       $writer->writeTag('div', array('class' => 'a-balloon-title'));
       $writer->writeText($component->getTitle());
       $writer->writeClosedTag('div');
       $writer->writeTag('div', array( 'id' => $component->getClientId() . ":message", 'class' => 'a-balloon-message'));
        
    }
    
//    /**
//     * @param Adept_Component_Message_Balloon $component
//     */
//    public function renderChildren($component)
//    {
//    }
    
    /**
     * @param Adept_Component_Message_Balloon $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeClosedTag('div');
        $writer->writeClosedTag('div');
            
        
        $writer->writeScriptBegin();
        $offset =  array();
        
        if ($component->getOffsetLeft()) {
            $offset['offsetLeft'] = (int) $component->getOffsetLeft();
        }
        
        if ($component->getOffsetTop()) {
            $offset['offsetTop'] = (int) $component->getOffsetTop();
        }
        
        $this->renderClientController($component->getClientId(), 'Adept.Controller.Message.Balloon', array($component->getFor()), $offset);
        $writer->writeScriptEnd();
        
        
    }
}