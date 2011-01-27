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

class Adept_Renderer_DatePicker extends Adept_Renderer_Composite 
{
    
    /**
     * @param Adept_Component_DatePicker $component
     */
    public function renderBegin($component) 
    {        
        $attributes = array(
            'id' => $component->getId(),
            'type' => 'text',
            'class' => $component->getClass(),
            'style' => $component->getStyle(),
            'name' => $component->getName(),
            'value' => $component->getDisplayValue(),
            'size' => $component->getSize(),
            'maxlength' => $component->getMaxLength(),
            'accesskey' => $component->getAccessKey(),
            'alt' => $component->getAlt(),
            'disabled' => $component->isDisabled() ? 'true' : null,
            'tabindex' => $component->getTabIndex(),
            'readonly' =>  'true',
        );        
        
        $attributes = array_merge($attributes, $component->getBrowserEvents());        
        
        $component->getWriter()->write('<table><tr><td>');
        $component->getWriter()->writeHtmlTag('input', $attributes, true);
        $component->getWriter()->write('</td><td>');

        $attributes = Array(
            'id' => $component->getId() . 'Btn',
            'style' => $component->getButtonStyle(),
            'class' => $component->getButtonClass(),
        );
        $component->getWriter()->writeHtmlTag('span', $attributes, true);
        $component->getWriter()->writeClosedHtmlTag('span');
        $component->getWriter()->write('</td></tr></table>');
    }

    /**
     * @param Adept_Component_DatePicker $component
     */
    public function renderEnd($component)
    {
        $component->getWriter()->write('<script type="text/javascript">');
        $component->getWriter()->write('
          Calendar.setup(
          {
              inputField  : "' . $component->getId() . '",
              ifFormat    : "' . $component->getDateFormat() . '",
              button      : "' . $component->getId() . 'Btn"
          });');
        $component->getWriter()->write('</script>');
    }
    
}
