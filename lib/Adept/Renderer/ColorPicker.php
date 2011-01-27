<?php

class Adept_Renderer_ColorPicker extends Adept_Renderer_AbstractInput 
{

    protected function renderColorMap($component)
    {
        $writer = $this->getWriter();
        
        $writer->writeTag('div', array('id' => $component->getClientId() . ':colorMap', 'class' => 'a-color-map'));
        $writer->writeTag('img', array('id' => $component->getClientId() . ':colorMap:l1', 'width' => 128, 'height' => 128, 
            'src' => PROJECT_STATIC_URL . '/img/Adept/ColorPicker/blank.gif',
            'style' => 'display: block; padding: 0; border: 0; '), true);
        $writer->writeTag('img', array('id' => $component->getClientId() . ':colorMap:l2', 'width' => 128, 'height' => 128,     
            'src' => PROJECT_STATIC_URL . '/img/Adept/ColorPicker/map-hue-128.png',
            'style' => 'display: block; background-color: transparent; clear: both; margin: -128px 0 0 0; padding: 0; border: 0; '), true);
        $writer->writeTag('/div');
    }

    protected function renderColorBar($component)
    {
        $writer = $this->getWriter();
        
        $writer->writeTag('div', array('id' => $component->getClientId() . ':colorBar', 'class' => 'a-color-bar', 'style' => 'margin: 0 10px; '));
        $writer->writeTag('img', array('width' => 20, 'height' => 128, 'src' => PROJECT_STATIC_URL . '/img/Adept/ColorPicker/bar-hue-128.png',
            'style' => 'display: block; '), true);
        $writer->writeTag('/div');
    }
    
    /**
     * @param Adept_Component_ColorPicker $component
     */
    protected function renderColorControls($component)
    {
        $writer = $this->getWriter();
    	$writer->writeTag('table', array('cellspacing' => 0, 'cellpadding' => 0, 'border' => 0));
    	
    	$writer->writeTag('tr');
    	$writer->writeTag('td', array('colspan' => 2));
    	$writer->writeTag('div', array('id' => $component->getClientId() . ':preview', 'class' => 'a-color-preview', 
    	   'style' => 'width: 64px; height: 64px; display: block; border: 1px solid #000; '));
    	$writer->writeTag('/div');
    	$writer->writeTag('/td');
    	$writer->writeTag('/tr');

        $writer->writeTag('tr');
        $writer->writeTag('td', array('valign' => 'bottom'));
        $writer->writeText('#');
        $writer->writeTag('/td');
        $writer->writeTag('td', array('style' => 'padding-top: 8px;'));
        $writer->writeTag('input', array('type' => 'text', 'maxlength' => 6, 'id' => $component->getClientId() . ':hex',
            'style' => 'width: 58px;'), true);
        $writer->writeTag('/td');
        $writer->writeTag('/tr');
        
        $writer->writeTag('tr');
        $writer->writeTag('td', array('colspan' => 2, 'style' => 'padding-top: 8px;'));
        $writer->writeTag('input', array('type' => 'button', 'value' => 'Ok', 'id' => $component->getClientId() . ':chooseBtn', 
            'style' => 'width: 64px; '));
        $writer->writeTag('/td');
        $writer->writeTag('/tr');
        
        
    	$writer->writeTag('/table');
    }
    
    /**
     * @param Adept_Component_ColorPicker $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        
        $attributes = array(
            'id' => $component->getClientId(),
            'type' => 'text',
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
            'name' => $component->getClientId(),
            'value' => $this->getDisplayValue($component),
            'maxlength' => 7,
            'accesskey' => $component->getAccessKey(),
            'alt' => $component->getAlt(),
            'disabled' => $component->isDisabled(),
            'tabindex' => $component->getTabIndex(),
        );
        
        $writer->writeTag('input', $attributes, true);

        $attributes = array(
            'id' => $component->getClientId() . ':button',
            'style' => $component->getButtonStyle(),
            'class' => $component->getButtonClass(),
            'type' => 'button'
        );
        
        $writer->writeTag('button', $attributes);
        $writer->writeHtml($component->getButtonTitle());
        $writer->writeTag('/button');        
        
        $writer->writeTag('div', array('id' => $component->getClientId() . ':container', 
            'style' => 'display: none; position: absolute; background-color: #fff; border: 1px solid #000; '));
        
    	$writer->writeTag('table', array('cellspacing' => 2, 'cellpadding' => 2, 'border' => 0));
    	$writer->writeTag('tr');
    	$writer->writeTag('td', array('valign' => 'top'));
    	$this->renderColorMap($component);
    	$writer->writeTag('/td');
        $writer->writeTag('td', array('valign' => 'top', 'width' => 40));
        $this->renderColorBar($component);
        $writer->writeTag('/td');
        $writer->writeTag('td', array('valign' => 'top'));
        $this->renderColorControls($component);
        $writer->writeTag('/td');
        $writer->writeTag('/tr');
    	$writer->writeTag('/table');
    }
    
    /**
     * @param Adept_Component_ColorPicker $component
     */
    public function renderEnd($component)
    {
    	$writer = $this->getWriter();
    	
        $writer->writeTag('/div');
    	
    	$writer->writeTag('img', array(
    	   'id' => $component->getClientId() . ':colorMap:l2:marker',
    	   'src' => PROJECT_STATIC_URL . '/img/Adept/ColorPicker/mappoint.gif', 
    	   'style' => 'position: absolute; left: 0; top: 0; border: 0; display: none; ',
    	), true);
    	
    	$writer->writeTag('img', array(
           'id' => $component->getClientId() . ':colorBar:marker',
           'src' => PROJECT_STATIC_URL . '/img/Adept/ColorPicker/rangearrows.gif', 
           'style' => 'position: absolute; left: 0; top: 0; border: 0; display: none; ',
        ), true);
    	
    	$writer->writeScriptBegin();
    	$this->renderClientController($component->getClientId(), 'Adept.Controller.ColorPicker');
    	$writer->writeScriptEnd();
    	
    	
    	
    }
    
    public function getRequiredJs()
    {
    	return array('Adept/Color.js', 'Adept/Controller.js', 'Adept/Controller/ColorPicker.js'
    	   , 'Adept/Controller/ColorPicker/Marker.js', 'Adept/Controller/ColorPicker/ValueControl.js');
    }
    
    
    
}


