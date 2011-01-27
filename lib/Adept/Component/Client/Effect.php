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

class Adept_Component_Client_Effect extends Adept_Component_AbstractBase 
{
    
    public function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('type');
        $this->addPropertyDescription("for", array(), array(), null);
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
    // Properties---------------------------------------------------------------
    
    public function getType() 
    {
       return $this->getProperty('type');
    }
    
    public function setType($type) 
    {
       $this->setProperty('type', $type);
    }
    
    public function getFor() 
    {
       return $this->getProperty('for');
    }
    
    public function setFor($for) 
    {
       $this->setProperty('for', $for);
    }
    
    protected function isSystemAtributes($name)
    {
    	return $name == '_file' || $name == '_line';
    }
    
    
    public function renderBegin()
    {
        
        $writer = $this->getResponseWriter();
        
        $writer->writeHtml("Adept.Effect.Factory.create('{$this->getFor()}', '{$this->getType()}')");
        
        foreach ($this->getAttributes() as $name => $value){
        	if(!$this->isSystemAtributes($name)){
        		
	            $writer->writeHtml(".{$name}('{$value}')");
        	}
        }
        $writer->writeHtml(".go()");
        
        if (!($this->getParent() instanceof Adept_Component_Client_ParallelEffect)) {
            $writer->writeHtml(";");
        }
        
    }
    
    public function getRequiredJs()
    {
        $fileName = "Adept/Effect/" . ucfirst($this->getType()) . ".js";
       return array(
          "Adept/Effect/Base.js",
          "Adept/Effect/Factory.js",
          $fileName
       );
    }
    
}