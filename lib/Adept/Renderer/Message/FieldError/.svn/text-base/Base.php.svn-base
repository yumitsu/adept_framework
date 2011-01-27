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

class Adept_Renderer_Message_FieldError_Base extends Adept_Renderer_AbstractControl 
{
    
    /**
     * @param Adept_Component_Message_FieldError $component
     */
    public function renderBegin($component)
    {
        $this->getWriter()->writeTag('span', array(
            'id' => $component->getDomContainerId(),
//            'class' => $component->getCssClass(),
//            'style' => $component->getCssStyle(),
        ));
    }
    
    /**
     * @param Adept_Component_Message_FieldError $component
     */
    public function renderChildren($component)
    {
        $message = $component->getMessage();
        if ($message) {
            $this->getWriter()->writeText($message->getTitle());
        }
    }
    
    /**
     * @param Adept_Component_Message_FieldError $component
     */
    public function renderEnd($component)
    {
        $this->getWriter()->writeClosedTag('span');
        $this->getWriter()->writeScriptBegin();
        $writer = $this->getWriter();
//        $formId = $component->getRootView()->findChildByClientId($component->getFor())->getForm()->getClientId();
        $writer->writeHtml("Adept.Observer.addListener(window,'load', function(){
        
        ");  
        $this->renderClientController($component->getClientId(), 'Adept.Controller.Message.Base',
            array($component->getFor()), array());
         
        $writer->writeHtml("});");
        $this->getWriter()->writeScriptEnd(); 
        
    }
    
}