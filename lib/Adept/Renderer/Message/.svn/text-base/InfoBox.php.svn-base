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

class Adept_Renderer_Message_InfoBox extends Adept_Renderer_AbstractControl 
{
    protected $clientController = 'Adept.Controller.Message.InfoBox';
    
    /**
     * @param Adept_Component_Message_InfoBox $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        $atributes = array("class" => "a-infobox " . $component->getCssClass(), 
                           "id" => $component->getClientId(),
                           "style" => $component->getCssStyle(),
                           
         ) ;
         
         $writer->writeHtmlTag("div", $atributes);
         $writer->writeHtmlTag("div", array( "class" => "a-infobox-title"));
         $writer->writeHtml($component->getTitle());
         $writer->writeHtmlTag("span", array( 
                                            "class" => "a-infobox-icon", 
                                            "id" => $component->getClientId() . "_Icon") );
         
         $writer->writeClosedHtmlTag("span");
         $writer->writeClosedHtmlTag("div");
         
         $writer->writeHtmlTag("p", array('class' => "a-infobox-content"));
    }
    
    /**
     * @param Adept_Component_Message_InfoBox $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeClosedHtmlTag("p");
        $writer->writeClosedHtmlTag("div");
        $writer->writeScriptBegin();
        $this->renderClientController($component->getClientId(), $this->getClientController());
        $writer->writeScriptEnd();
    }
    
    public function getClientController()
    {
        return $this->clientController;
    }

    public function getRequiredJs()
    {
        return array('Adept/Controller.js', 'Adept/Controller/Message/InfoBox.js');
    }
}