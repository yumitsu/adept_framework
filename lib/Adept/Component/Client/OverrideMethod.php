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
 * @package    Adept_Component
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Component_Client_OverrideMethod extends Adept_Component_AbstractBase 
{

    private $jsController = '';
    
    public function hasRenderer()
    {
        return false;
    }
    
    public function defineProperties()
    {
        $this->addPropertyDescription('name', array(), null, self::TYPE_STRING);
    }
    
    public function getName() 
    {
       return $this->getProperty('name');
    }
    
    public function setName($name) 
    {
       $this->setProperty('name', $name);
    }
    
    public function renderBegin()
    {
        $writer = $this->getResponseWriter();
        $this->jsController = $writer->generateIdentifier();
        $jsScript = $this->findParentByClass("Adept_Component_Client_JsScript");
        if ($jsScript == null) {
            throw new Adept_Exception_IllegalState("Override tag must be placed in JSCRIP");
        }
        $clientId = $jsScript->getParent()->getClientId();
        $writer->writeHtml("var " . $this->jsController . "= Adept.Application.getController('" . $clientId . "');");
//        TODO make normal $super implementation  
//        $writer->writeHtml('var $super = ' . $this->jsController . "." . $this->getName() . ".bind({$this->jsController});");
        
        $writer->writeHtml($this->jsController . "." . $this->getName() . '= function(');
        $attributes = $this->findChildrenByClass("Adept_Component_Client_MethodAttribute");
        
        foreach ($attributes as $attribute){
        
                $writer->writeText(",");
        
        
            $writer->writeHtml($attribute->getName());;
        }
        $writer->writeHtml("){");
        
    }
    
    public function renderEnd()
    {
        $writer = $this->getResponseWriter();
        $writer->writeHtml("}.bind($this->jsController);");
    }
    
}