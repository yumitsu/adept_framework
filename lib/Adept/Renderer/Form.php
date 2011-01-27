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

class Adept_Renderer_Form extends Adept_Renderer_AbstractControl 
{
    protected $clientController = 'Adept.Controller.Form';    

    /**
     * @param Adept_Component_Form $component
     */
    public function handleRequest($component)
    {
        $component->setValid(true);
        
        $request = $this->getContext()->getRequest();
        $submitted = $request->get('submitted');
        
        if (is_array($submitted) && isset($submitted[$component->getClientId()])) {
            $component->setSubmitted(true);
        } else {
            $component->setSubmitted(false);
        }
    }

    /**
     * @param Adept_Component_Form $component
     */    
    public function renderBegin($component)
    {
        $attributes = array(
            'id' => $component->getClientId(),
            'name' => $component->getClientId(),
            'class' => $component->getCssClass(),
            'accept' => $component->getAccept(),
            'acceptcharset' => $component->getAcceptCharset(),
            'action' => $component->getAction(),
            'method' => $component->getMethod(),
            'style' => $component->getCssStyle(),
            'enctype' => $component->getEnctype(),
            'target' => $component->getTarget(),
        );

        $attributes = array_merge($attributes, $component->getBrowserEvents());
//        TODO div should be rendered only for ajax mode
//        if ($component->isAjax()) {
        if ($component->isControllerNeeded()) {
            $this->getWriter()->writeHtmlTag('div', array(
                'id' => $component->getDomContainerId(),
                'style' => 'display: inline; ',
            ));
//        }
        }
        $this->getWriter()->writeTag('form', $attributes);
    }

    /**
     * @param Adept_Component_Form $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        
        $attributes = array(
            'type' => 'hidden',
            'name' => 'submitted[' . $component->getClientId() . ']',
            'value' => 1,
        );
        
        $writer->writeTag('input', $attributes, true);
        $writer->writeClosedTag('form');
        
        if ($component->isControllerNeeded()) {
        
            $writer->writeScriptBegin();            
            $clientId = $component->getClientId();
            
            $properties = array(
                'ajax' => $component->isAjax(),
                'action' => $component->getAction()
            );
            
            
            $this->renderClientController($clientId, $this->getClientController(), array(), $properties);
            $writer->writeScriptEnd();
            
            $writer->writeClosedTag("div");
        }
        
    }
    
    public function getClientController()
    {
        return $this->clientController;
    }
    
    /**
     * @param Adept_Component_Form $component
     * @return array
     */
    public function getRequiredJs($component)
    {
        if ($component->isControllerNeeded()){
            return array('Adept/Controller.js', 'Adept/Controller/Form.js');
        }
        
        return array();
    }

}