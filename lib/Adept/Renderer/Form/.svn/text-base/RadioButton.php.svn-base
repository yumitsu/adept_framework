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

class Adept_Renderer_Form_RadioButton extends Adept_Renderer_AbstractInput  
{
    
    /**
     * @param Adept_Component_Form_RadioButton $component
     */
    public function renderBegin($component) 
    {   
        $writer = $this->getWriter();
        
        $label = $component->getLabel();
        
        if ($label != null)  {
            $writer->writeTag('label');    
        }
        
        $attributes = array(
            'id' => $component->getClientId(),
            'type' => 'radio',
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
            'name' => $component->getGroup(),
            'checked' => $component->isChecked(),
            'value' => $component->getCheckedValue(),
            'accesskey' => $component->getAccessKey(),
            'alt' => $component->getAlt(),
            'disabled' => $component->isDisabled(),
            'tabindex' => $component->getTabIndex(),
        );        
        
        $attributes = array_merge($attributes, $component->getBrowserEvents());
        
        $writer->writeTag('input', $attributes, true);
        
        if ($label != null) {
            $writer->writeText($label);
            $writer->writeTag('/label');
        }
    }
    
}