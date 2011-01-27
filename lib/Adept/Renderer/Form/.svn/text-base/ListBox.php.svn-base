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

class Adept_Renderer_Form_ListBox extends Adept_Renderer_AbstractInput 
{

//    /**
//     * @param Adept_Component_Form_ListBox $component
//     * @return void
//     */
//    public function handleRequest($component)
//    {
//                    
//    }

    /**
     * @param Adept_Component_Form_ListBox $component
     * @return void
     */
    public function renderBegin($component)
    {
        
        $name = $component->getClientId();
        if ($component->isMultiple()){
            $name .= '[]'; 
        }
        $attributes = array(
            'id' => $component->getClientId(),
            'name' => $name,
            'style' => $component->getCssStyle(),
            'class' => $component->getCssClass(),
            'size' => $component->getSize(),
            'multiple' => $component->isMultiple()
        );

        $attributes = array_merge($attributes, $component->getBrowserEvents());

        $writer = $this->getWriter()->writeTag('select', $attributes);
    }

    /**
     * @param Adept_Component_Form_ListBox $component
     * @return void
     */
    public function renderChildren($component)  
    {
        $writer = $this->getWriter();
        
        foreach ($component->getSelectItemsIterator() as $item) {
            $selected = $component->isItemSelected($item->getValue());
            $writer->writeTag('option', array(
                'id' => $item->getClientId(),
                'value' => $item->getValue(), 
                'selected' => $selected,
                'disabled' => $item->isDisabled()
            ));
            $writer->writeHtml($item->getTitle());
            $writer->writeClosedTag('option');
        }
    }

    /**
     * @param Adept_Component_Form_ListBox $component
     * @return void
     */
    public function renderEnd($component)
    {
        $this->getWriter()->writeClosedTag('select');
        $this->renderClientListener($component);
    }
    
    
    /**
    * @param Adept_Component_Form_ListBox $component
    */
    
    protected function renderClientListener($component)
    {
    	$listeners = $component->findChildrenByClass('Adept_Component_Client_Listener');
    	foreach ($listeners as $listener){
    	    $listener->render();
    	}
    }
}
