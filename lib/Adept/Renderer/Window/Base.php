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

class Adept_Renderer_Window_Base extends Adept_Renderer_AbstractControl 
{
    
    /**
     * @param Adept_Component_Window $component
     */
    public function handleRequest($component)
    {
        $request = Adept_Context::getInstance()->getRequest();
        if ($request->has('event')) {
            $event = $request->get('event');
            if (isset($event[$component->getClientId()]) && $event[$component->getClientId()] == Adept_Component_Window::SHOW_EVENT) {
                $component->markDirty(Adept_Component_DirtyState::CHILDREN);
            }
        }
    }
    
     /**
     * @param Adept_Component_Window $component
     */   
    protected function renderHead($component)
    {
        $writer = $this->getWriter();
        
        $writer->writeTag('div', array('class' => $component->getRealCssClassName('window-head'), "id" => $component->getClientId() . '_head'));
        $writer->writeTag('div', array('class' => $component->getRealCssClassName('window-icons')));
        if ($component->isClosable()){
            $writer->writeTag('div', 
                array('id' => $component->getClientId() . 'CloseIcon' , 'class' => $component->getRealCssClassName('window-icons-close')));
            $writer->writeClosedTag('div');
        }
        $writer->writeClosedTag('div');
        $titleClass = $component->getRealCssClassName('window-title');
        if ($component->isDraggable()){
            $titleClass .= " {$component->getRealCssClassName('draggable')}";
        }
        $writer->writeTag('div', array('id' => $component->getClientId() . "_title", 'class' => $titleClass) );
        $writer->writeHtml($component->getTitle());
        $writer->writeClosedTag('div');
        $writer->writeClosedTag('div');
    }
    
    /**
     * @param Adept_Component_Window $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        
        $class = $component->getRealCssClassName('window');
        if ($component->getCssClass()) {
            $class .= ' ' . $component->getCssClass(); 
        }
        
        $writer->writeTag('div', 
            array( 'id' => $component->getClientId(),
                   'class' => $class,
                   'style'=> "height:{$component->getHeight()}px;width:{$component->getWidth()}px;top:{$component->getTop()}px;left:{$component->getLeft()}px;"));
        $this->renderHead($component);
        $writer->writeTag('div', array('class' => $component->getRealCssClassName('window-content-border')));
        $writer->writeTag('div', array('id' => $component->getDomContainerId(),'class' => $component->getRealCssClassName('window-content')));
    }

    /**
     * @param Adept_Component_Window $component
     */
    public function renderChildren($component)
    {
     if (!$component->isAjaxLoading()) {
            parent::renderChildren($component);
        } else {
            if ($component->getDirtyState() ==  Adept_Component_DirtyState::CHILDREN) {
                parent::renderChildren($component);
            } else {
                $this->getWriter()->writeHtml("&nbsp;");
            }
        }
    }
    
    /**
     * @param Adept_Component_Window $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeClosedTag('div');
        $writer->writeClosedTag('div');
        $writer->writeClosedTag('div');
        $this->renderWindowController($component);
        
    }
    
    /**
     * @param Adept_Component_Window $component
     */
    public function renderWindowController($component)
    {
        $writer = $this->getWriter();
        $writer->writeScriptBegin();
        $this->renderClientController($component->getClientId(), 
           'Adept.Controller.Window',array($component->isDraggable()), array('ajaxLoading'=> $component->isAjaxLoading(),
                                                    'forceUpdate' => $component->isForceUpdate()));
        $writer->writeScriptEnd();
    }
    
    /**
     * @param Adept_Component_Window $component
     */
    
    
    public function getRequiredJs($component)
    {
         $controllers = array('Adept/Controller/Window.js', 'Adept/Controller/Window/Utils.js', 'Adept/Controller/Window/Overlay.js');
         if ($component->isDraggable())
         {
             $controllers[] = 'scriptaculous/effects.js';
             $controllers[] = 'scriptaculous/dragdrop.js';
         }
          return $controllers;
    }
}