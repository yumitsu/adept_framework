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

class Adept_Renderer_Form_Button extends Adept_Renderer_Base_Button
{

    protected $clientControllerClass = 'Adept.Controller.Form.Button';

    /**
     * @param Adept_Component_Form_Button $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        $clientId = $component->getClientId();
        $formId = ($component->getForm() != null) ? $component->getForm()->getClientId() : null;
        $attributes = array('id' => $clientId, 'type' => 'submit',
        'class' => $component->getCssClass(), 
        'style' => $component->getCssStyle(), 
        'tabindex' => $component->getTabIndex(), 
        'disabled' => $component->isDisabled(), 
        'accesskey' => $component->getAccessKey(), 
        'name' => $clientId, 
        'value' => $component->getTitle());
        
        $attributes = array_merge($attributes, $component->getBrowserEvents());
        $writer->writeTag('input', $attributes, true);
        if ($component->isControllerNeeded()) {
            $writer->writeScriptBegin();
            $this->renderClientController($clientId, $this->clientControllerClass, array(), array('formId' => $formId, 'ajax' => $component->isAjax()));
            $writer->writeScriptEnd();
        }
    }

    public function getRequiredJs($component)
    {
       if ($component->isControllerNeeded()){
            return array('Adept/Controller/Form/AbstractButton.js', 'Adept/Controller/Form/Button.js');
       }
       return array();
    }
    
}
    