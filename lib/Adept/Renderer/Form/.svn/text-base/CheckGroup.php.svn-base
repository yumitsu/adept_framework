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

class Adept_Renderer_Form_CheckGroup extends Adept_Renderer_Base_SelectInput 
{

    /**
     * @param Adept_Component_Form_CheckGroup $component
     */
    public function handleRequest($component) 
    {
        $component->setValid(true);
        
        $request = $this->getContext()->getRequest();
        
        if ($request->has($component->getClientId())) {
            $component->setSubmittedValue($request->get($component->getClientId()));
        } else {
            $parentForm = $component->getForm();
            if ($parentForm && $parentForm->isSubmitted()) {
                $component->setSubmittedValue(array());
            }
        }
    }
    
    public function renderBegin($component)
    {
    }
    
    /**
     * @param Adept_Component_Form_CheckGroup $component
     */
    public function renderChildren($component)
    {
        $writer = $this->getWriter();
        
        $writer->writeTag('table', array(
                                        'border' => 0,
                                        'cellpadding' => 0,
                                        'cellspacing' => 0,
                                        'class' => $component->getLayoutCssClass(),
                                        'style' => $component->getLayoutCssStyle()
                                    ));
        if ($component->getPlacement() == Adept_Component_Form_CheckGroup::HORIZONTAL_PLACEMENT) {
            $writer->writeTag('tr');
        }
        
        foreach ($component->getSelectItemsIterator() as $key => $item) {
            if ($component->getPlacement() == Adept_Component_Form_CheckGroup::VERTICAL_PLACEMENT) {
                $writer->writeTag('tr');
            }
            $writer->writeTag('td');
            $this->renderCheckBox($component, $item, $key);
            $writer->writeClosedTag('td');
            if ($component->getPlacement() == Adept_Component_Form_CheckGroup::VERTICAL_PLACEMENT) {
                $writer->writeClosedTag('tr');
            }
        }
        
        if ($component->getPlacement() == Adept_Component_Form_CheckGroup::HORIZONTAL_PLACEMENT) {
            $writer->writeClosedTag('tr');
        }
        $writer->writeClosedTag('table');
    }
    
    public function renderCheckBox($component, $item, $itemIndex)
    {
        $writer = $this->getWriter();

        $selected = $component->isItemSelected($item->getValue());
        
        $attributes = array(
            'name' => "{$component->getClientId()}[{$itemIndex}]",
            'id' => "{$component->getClientId()}[{$itemIndex}]",
            'type' => 'checkbox',
            'value' => $item->getValue(),
            'style' => $component->getCssStyle(),
            'class' => $component->getCssClass(),
            'checked' => $selected,
        );
        
        $writer->writeTag('label');
        $writer->writeTag('input', $attributes, true);    
        $writer->writeText($item->getTitle());
        $writer->writeClosedTag('label');
        $writer->writeText("\n");
    }

    private function getItemClientId($component, $itemIndex)
    {
        return "{$component->getClientId()}[{$itemIndex}]";
    }
    
    public function renderEnd($component)
    {
        $this->renderClientListener($component);
    }    

    /**
    * @param Adept_Component_Form_CheckGroup $component
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