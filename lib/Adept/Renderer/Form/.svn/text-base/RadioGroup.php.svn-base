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

class Adept_Renderer_Form_RadioGroup extends Adept_Renderer_Base_SelectInput
{

    public function renderBegin($component)
    {
        
    }
    
    /**
     * @param Adept_Component_Form_RadioGroup $component
     */
    public function renderChildren($component)
    {
        $writer = $this->getWriter();
        switch ($component->getLayout()) {
            case Adept_Component_Form_RadioGroup::LAYOUT_TABLE:
                $writer->writeTag('table',
                    array(
                        'border' => 0,
                        'cellpadding' => 0,
                        'cellspacing' => 0,
                        'class' => $component->getLayoutCssClass(),
                        'style' => $component->getLayoutCssStyle(),
                ));
                if ($component->getPlacement() == Adept_Component_Form_RadioGroup::HORIZONTAL_PLACEMENT) {
                    $writer->writeTag('tr');
                }
                break;
            case Adept_Component_Form_RadioGroup::LAYOUT_OL:
                $writer->writeTag('ol',
                                  array(
                                    'class' => $component->getLayoutCssClass(),
                                    'style' => $component->getLayoutCssStyle(),
                              ));
                break;
            case Adept_Component_Form_RadioGroup::LAYOUT_UL:
                $writer->writeTag('ul',
                                  array(
                                    'class' => $component->getLayoutCssClass(),
                                    'style' => $component->getLayoutCssStyle(),
                              ));
                break;
        }
        
        foreach ($component->getSelectItemsIterator() as $key => $item) {
            switch ($component->getLayout()) {
                case Adept_Component_Form_RadioGroup::LAYOUT_TABLE:
                    if ($component->getPlacement() == Adept_Component_Form_RadioGroup::VERTICAL_PLACEMENT) {
                        $writer->writeTag('tr');
                    }
                    $writer->writeTag('td');
                    break;
                case Adept_Component_Form_RadioGroup::LAYOUT_OL:
                case Adept_Component_Form_RadioGroup::LAYOUT_UL:
                    if ($component->getPlacement() == Adept_Component_Form_RadioGroup::HORIZONTAL_PLACEMENT) {
                        $writer->writeTag('li', array('style' => 'float:left;'));
                    } else {
                        $writer->writeTag('li');
                    }
                    break;
            }
            
            $this->renderRadioButton($component, $item, $key);
            
            switch ($component->getLayout()) {
                case Adept_Component_Form_RadioGroup::LAYOUT_TABLE:
                    $writer->writeClosedTag('td');
                    if ($component->getPlacement() == Adept_Component_Form_RadioGroup::VERTICAL_PLACEMENT) {
                        $writer->writeClosedTag('tr');
                    }
                    break;
                case Adept_Component_Form_RadioGroup::LAYOUT_OL:
                case Adept_Component_Form_RadioGroup::LAYOUT_UL:
                    $writer->writeClosedTag('li');
                    break;
            }
        }
        switch ($component->getLayout()) {
            case Adept_Component_Form_RadioGroup::LAYOUT_TABLE:
                if ($component->getPlacement() == Adept_Component_Form_RadioGroup::HORIZONTAL_PLACEMENT) {
                    $writer->writeClosedTag('tr');
                }
                $writer->writeClosedTag('table');
                break;
            case Adept_Component_Form_RadioGroup::LAYOUT_OL:
                $writer->writeClosedTag('ol');
                break;
            case Adept_Component_Form_RadioGroup::LAYOUT_UL:
                $writer->writeClosedTag('ul');
                break;
        }
    }
    
    /**
     * @param Adept_Component_Form_RadioGroup $component
     */
    public function renderRadioButton($component, $item, $itemIndex)
    {
        $writer = $this->getWriter();
        $selected = $component->isItemSelected($item->getValue());
        
        $attributes = array(
            'id' => $this->getItemClientId($component, $itemIndex),
            'name' => $component->getClientId(),
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
            'type' => 'radio',
            'value' => $item->getValue(),
            'checked' => $selected,
            'onchange' => $component->getBrowserEvent('onchange'),
        );
        
        $attributes = array_merge($attributes, $component->getBrowserEvents());
        
        $writer->writeTag('label');
        $writer->writeTag('input', $attributes, true);    
        $writer->writeText($item->getTitle());
        $writer->writeClosedTag('label');
    }
    
    private function getItemClientId($component, $itemIndex)
    {
    	return $component->getClientId() . Adept_Component_NamingContainer::SEPARATOR . $itemIndex;
    }

    public function renderEnd($component)
    {
        $this->renderClientListener($component);
    }

    /**
    * @param Adept_Component_Form_RadioGroup $component
    */
    protected function renderClientListener($component)
    {
        $listeners = $component->findChildrenByClass('Adept_Component_Client_Listener');
        foreach ($listeners as $listener){
             foreach ($component->getSelectItemsIterator() as $key => $item) {
                $listener->setFor($this->getItemClientId($component, $key));
                $listener->render();     
             }
            
        }
    }
}