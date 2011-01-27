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

class Adept_Renderer_Client_Listener extends Adept_Renderer_Base 
{
    /**
     * @param Adept_Component_Client_Listener $component
     */
    public function renderBegin($component)
    {
        
        $writer = $this->getWriter();
        $writer->writeScriptBegin();
//        $jsScript = $component->findParentByClass("Adept_Component_Client_JsScript");
//        if ($jsScript == null) {
//            throw new Adept_Exception_IllegalState("Override tag must be placed in JSSCRIPT tag");
//        }
        if (!in_array($component->getEvent(), Adept_Component_Client_Listener::$domModificationEvents)) {
        
        $clientId = $component->getFor();
        
        $writer->writeText("Adept.Observer.addListener('{$clientId}'
            , '{$component->getEvent()}', function(event){ ");
        }
        
    }
    
    /**
     * @param Adept_Component_Client_Listener $component
     */
    public function renderChildren($component)
    {
        
        if (!in_array($component->getEvent(), Adept_Component_Client_Listener::$domModificationEvents)) {
           parent::renderChildren($component);
        }
        else {
           if($component->getParent()->getDirtyState() !== Adept_Component_DirtyState::NOTHING){
               parent::renderChildren($component);
           }
        }
    }
    
    /**
     * @param Adept_Component_ClientListener $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        if (!in_array($component->getEvent(), Adept_Component_Client_Listener::$domModificationEvents)) {
        $writer->writeText("});");
        }
        $writer->writeScriptEnd();

    }
    
}
