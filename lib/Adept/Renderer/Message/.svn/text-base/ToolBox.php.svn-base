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

class Adept_Renderer_Message_ToolBox extends Adept_Renderer_AbstractControl
{
    protected static $controllerClass = "Adept.Controller.Message.ToolBox";
    
    /**
     * @param Adept_Component_Message_ToolBox $component
     */

    public function handleRequest($component)
    {
        $request = Adept_Context::getInstance()->getRequest();
        $response = Adept_Context::getInstance()->getResponse();
        
        if ($component->isPersistent()) {
            $cookieName = $component->isAbsoluteId() ?  '_absolute' . $component->getClientId() . ':open': $component->getCookieId() . ":open";
            if ($request->hasCookie($cookieName)) {
               $component->setOpen($request->getCookie($cookieName));
            }    
        }
        
        if ($request->has('event')) {
            $event = $request->get('event');
            if (isset($event[$component->getClientId()]) && $event[$component->getClientId()] == Adept_Component_Message_ToolBox::SHOW_EVENT) {
                $component->markDirty(Adept_Component_DirtyState::CHILDREN);
            }
        }
    }
    
    /**
     * @param Adept_Component_Message_ToolBox $component
     */
    
    public function renderHead($component)
    {
        $writer = $this->getWriter();    
        
        $writer->writeHtml("<div class='{$component->getCssPrefix()}-toolbox-head' id='" . $component->getClientId() . ":head'>");
        
        $writer->writeHtml("<div class='{$component->getCssPrefix()}-toolbox-openclosebutton'></div>");
        $writer->writeHtml("<div class='{$component->getCssPrefix()}-toolbox-title'>");
        $writer->writeHtml($component->getTitle());
        $titleFacet = $component->getFacet(Adept_Component_Message_ToolBox::TITLE_FACET);
        if ($titleFacet != null) {
            $titleFacet->render();
        }
        $writer->writeHtml('</div>');
        $writer->writeHtml('</div>');
    }
    
    /**
     * @param Adept_Component_Message_ToolBox $component
     */   
    public function renderBody($component)
    {
        $writer = $this->getWriter();
        
        $writer->writeHtml("<div class='{$component->getCssPrefix()}-toolbox-body' id='" . $component->getClientId() . ":body'>");
        $writer->writeHtml("<div class='{$component->getCssPrefix()}-toolbox-body-content' id='" . $component->getDomContainerId() . "'>");
    }
    
    /**
     * @param Adept_Component_Message_ToolBox $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        
        $class = $component->getCssPrefix() . '-toolbox';
        
        if ($component->isOpen()) {
            $class .= ' ' . $component->getCssPrefix() . '-toolbox-open';
        } else {
            $class .= ' ' . $component->getCssPrefix() . '-toolbox-closed';
        }
        
        if ($component->getCssClass()) {
            $class .= ' ' . $component->getCssClass(); 
        }
        
        $writer->writeHtmlTag('div', array('class' => $class, 'id' => $component->getClientId(), 
            'style' => $component->getCssStyle()));
        $this->renderHead($component);
        $this->renderBody($component);
    }
    
    /**
     * @param Adept_Component_Message_ToolBox $component
     */
    public function renderChildren($component)
    {
        if (!$component->isAjaxLoading() || $component->isOpen()) {
            parent::renderChildren($component);
        } else {
            if ($component->getDirtyState() ==  Adept_Component_DirtyState::CHILDREN) {
                parent::renderChildren($component);
            }
        }
    }        
    
    /**
     * @param Adept_Component_Message_ToolBox $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeHtml('</div></div></div>');
        
        $writer->writeScriptBegin();
        $this->renderClientController($component->getClientId(), self::$controllerClass, array((bool) $component->isOpen(), 
            !$component->isAjaxLoading(), $component->getCssPrefix() . '-toolbox'));
        $writer->writeScriptEnd();
    } 
    
    public function getRequiredJs()
    {
        return array('Adept/Controller.js', 'Adept/Controller/Message/ToolBox.js');
    }
 
}
