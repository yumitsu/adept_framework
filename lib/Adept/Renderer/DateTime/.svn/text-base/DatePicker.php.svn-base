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

class Adept_Renderer_DateTime_DatePicker extends Adept_Renderer_AbstractInput 
{
    
    protected $converter;

    public function __construct()
    {
        $this->converter = new Adept_Converter_DateTime();
    }

    public function getConverter()
    {
        return $this->converter;
    }
        
    /**
     * @param Adept_Component_DateTime_DatePicker $component
     */
    public function renderBegin($component) 
    {        
        $attributes = array(
            'id' => $component->getClientId(),
            'type' => 'text',
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
            'name' => $component->getClientId(),
            'value' => $this->getDisplayValue($component),
            'size' => $component->getSize(),
            'maxlength' => $component->getMaxLength(),
            'accesskey' => $component->getAccessKey(),
            'alt' => $component->getAlt(),
            'disabled' => $component->isDisabled(),
            'tabindex' => $component->getTabIndex(),
            'readonly' =>  'true',
        );
        
        $attributes = array_merge($attributes, $component->getBrowserEvents());        
        
        $writer = $this->getWriter();
        
        $writer->writeHtml('<table><tr><td>');
        $writer->writeTag('input', $attributes, true);
        $writer->writeHtml('</td><td>');

        $attributes = array(
            'id' => $component->getClientId() . ':button',
            'style' => $component->getButtonStyle(),
            'class' => $component->getButtonClass(),
            'type' => 'button'
        );
        
        $writer->writeTag('button', $attributes);
        $writer->writeText($component->getButtonTitle());
        $writer->writeClosedTag('button');
        $writer->writeHtml('</td></tr></table>');
    }

    /**
     * @param Adept_Component_DateTime_DatePicker $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeScriptBegin();
        $this->renderClientController($component->getClientId(), 'Adept.Controller.DateTime.DatePicker', array($component->getDateFormat()));
        $writer->writeScriptEnd();
    }

    public function getRequiredJs()
    {
        return array('Adept/Controller.js', 'jscalendar/calendar.js', 'Adept/Controller/DateTime/DatePicker.js');
    }
    
    
}