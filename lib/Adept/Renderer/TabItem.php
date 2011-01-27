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

class Adept_Renderer_TabItem extends Adept_Renderer_AbstractControl 
{
    
    /**
     * @param Adept_Component_TabItem $component
     */
    public function handleRequest($component)
    {
        $request = Adept_Context::getInstance()->getRequest();
        
        if ($request->has('event')) {
            $event = $request->get('event');
            if (isset($event[$component->getClientId()]) && $event[$component->getClientId()] == Adept_Component_TabItem::SHOW_EVENT) {
                $component->markDirty(Adept_Component_DirtyState::CHILDREN);
            }
        }
        
    }

    /**
     * @param Adept_Component_TabItem $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        
        $class = $component->getParent()->getCssPrefix() . '-tab';
        
        $writer->writeHtmlTag('div', array(
            'id' => $component->getClientId(),
            'class' => $component->getCssClass() !== null ? getClass() : $class,
            'style' => $component->getCssStyle(),
        ));
    }
    
    /**
     * @param Adept_Component_TabItem $component
     */
    public function renderChildren($component)
    {
        if (!$component->isAjaxLoading() || ($component->isSelected())) {
            parent::renderChildren($component);
        } else {
            if ($component->getDirtyState() != Adept_Component_DirtyState::NOTHING) {
                parent::renderChildren($component);
            }
        }
    }
    
    /**
     * @param Adept_Component_TabItem $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeClosedHtmlTag('div');
    }

}