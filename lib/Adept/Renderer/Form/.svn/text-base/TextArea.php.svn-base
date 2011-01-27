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

class Adept_Renderer_Form_TextArea extends Adept_Renderer_AbstractInput 
{

    /**
     * @param Adept_Component_Form_TextArea $component
     */
    public function renderBegin($component)
    {
        $attributes = array(
            'id' => $component->getClientId(),
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
            'cols' => $component->getCols(),
            'rows' => $component->getRows(),
            'name' => $component->getClientId(),
            'accesskey' => $component->getAccessKey(),
            'alt' => $component->getAlt(),
            'disabled' => $component->isDisabled(),
            'tabindex' => $component->getTabIndex(),
            'readonly' => $component->isReadOnly(),
        );
        
        $attributes = array_merge($attributes, $component->getBrowserEvents());

        $this->getWriter()->writeTag('textarea', $attributes);
    }
    
    
    /**
     * @param Adept_Component_Form_TextArea $component
     */

    public function renderChildren($component)
    {
        $this->getWriter()->writeText($this->getDisplayValue($component));
    }
    
    
    /**
     * @param Adept_Component_Form_TextArea $component
     */
    public function renderEnd($component)
    {
        
        $this->getWriter()->writeClosedTag('textarea');
        $this->renderListeners($component);
    }
    
    
    /**
     * @param Adept_Component_Form_TextArea $component
     */
    
    protected function renderListeners($component)
    {
        
    	$listeners = $component->findChildrenByClass("Adept_Component_Client_Listener", false);
    	foreach ($listeners as $listener){
    	    $listener->render();
    	}
    	
    	
    	
    }

}
