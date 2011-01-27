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

class Adept_Renderer_Form_CommandLink extends Adept_Renderer_Base_Button
{

    protected $clientController = 'Adept.Controller.Form.CommandLink';

    /**
     * @param Adept_Component_Base_Button $component
     */
    public function handleRequest($component)
    {
        $request = $this->getContext()->getRequest();
        $component->setClicked(false);
        if (($event = $request->get('event')) != null) {
            if (isset($event[$component->getClientId()]) && $event[$component->getClientId()] == Adept_Component_Base_Button::CLICK_EVENT) {
                $component->setClicked(true);
            }
        }
    }

    /**
     * @param Adept_Component_Form_CommandLink $component
     */
    public function renderBegin($component)
    {
        $attributes = array('id' => $component->getClientId(), 'class' => $component->getCssClass(), 'style' => $component->getCssStyle() ? $component->getCssStyle() : 'cursor:pointer;', 'tabindex' => $component->getTabIndex(), 'accesskey' => $component->getAccessKey());
        $attributes = array_merge($attributes, $component->getBrowserEvents());
        $this->getWriter()->writeTag('span', $attributes);
    }

    /**
     * @param Adept_Component_Form_CommandLink $component
     */
    public function renderEnd($component)
    {
        $this->getWriter()->writeClosedTag('span');

        $this->getWriter()->writeScriptBegin();
            
        $formId = ($component->getForm() != null) ? $component->getForm()->getClientId() : null;
                    
        $this->renderClientController($component->getClientId(), $this->getClientController(), array(), 
            array('formId' => $formId, 'ajax' => $component->isAjax()));
            
        $this->getWriter()->writeScriptEnd();

    }

    public function getClientController()
    {
        return $this->clientController;
    }

    public function getRequiredJs()
    {
        return array('Adept/Controller/Form/AbstractButton.js', 'Adept/Controller/Form/Button.js', 'Adept/Controller/Form/CommandLink.js');
    }
}