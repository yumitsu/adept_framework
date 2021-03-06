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

class Adept_Renderer_Form_Hidden extends Adept_Renderer_AbstractInput 
{

    /**
     * @param Adept_Component_Form_TextBox $component
     */
    public function renderBegin($component) 
    {        
        $attributes = array(
            'id' => $component->getClientId(),
            'type' => 'hidden',
            'name' => $component->getClientId(),
            'value' => $this->getDisplayValue($component),
            'disabled' => $component->isDisabled(),
        );        
        $attributes = array_merge($attributes, $component->getBrowserEvents());
        $this->getWriter()->writeTag('input', $attributes, true);
    }

}