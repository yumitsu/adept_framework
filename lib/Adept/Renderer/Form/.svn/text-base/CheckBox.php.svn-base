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

class Adept_Renderer_Form_CheckBox extends Adept_Renderer_AbstractInput 
{
    
    /**
     * Handle request phase
     *
     * @param Adept_Component_Form_CheckBox $component
     */
    public function handleRequest($component)
    {
        $component->setValid(true);
        
        $request = $this->getContext()->getRequest();
        
        if ($request->has($component->getClientId()) != false) {
            $value = $request->get($component->getClientId());
            $component->setSubmittedValue(true);
        } else {
            if ($component->getForm() !== null && $component->getForm()->isSubmitted()) {
                $component->setSubmittedValue(false);
            }
        }
    }
    
    /**
     * @param Adept_Component_Form_CheckBox $component
     */
    public function isChecked($component)
    {
        if ($component->isSubmitted()) {
            return $component->getSubmittedValue();
        } else {
            return $component->isChecked();
        }
    }
    
    
    /**
     * @param Adept_Component_Form_CheckBox $component
     */
    public function renderBegin($component) 
    {        
        $attributes = array(
            'id' => $component->getClientId(),
            'type' => 'checkbox',
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
            'name' => $component->getClientId(),
            'checked' => $this->isChecked($component),
            'value' => $component->getCheckedValue(),
            'accesskey' => $component->getAccessKey(),
            'alt' => $component->getAlt(),
            'disabled' => $component->isDisabled(),
            'tabindex' => $component->getTabIndex(),
        );
        
        $attributes = array_merge($attributes, $component->getBrowserEvents());

        $writer = $this->getWriter();
        
        $writer->writeTag('input', $attributes, true);
        
        if ($component->getLabel() != null) {
            $writer->writeHtml('<label for="' . $component->getClientId() . '">');
            $writer->writeText($component->getLabel());
            $writer->writeHtml('</label>' . "\n");
        }
    }        
    
}
    