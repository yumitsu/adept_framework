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

class Adept_Component_Client_Command_ShowWindow extends Adept_Component_Client_Command_Base
{
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('windowId');
        $this->addPropertyDescription('center', array(), false);
        $this->addPropertyDescription('modal', array(), false);
        $this->addPropertyDescription('placement', array(), null);
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
    public function renderBegin()
    {
        $writer = $this->getResponseWriter();
        $modal = $this->isModal() ? 1 : 0;
        if ($this->isCenter()){
            $writer->writeHtml("Adept.Application.getController('{$this->getWindowId()}').showCenter({$modal})");
        }else {
            if($this->getPlacement() !== null){
               
                $writer->writeHtml("Adept.Application.getController('{$this->getWindowId()}').showRelated(event, '{$this->getPlacement()}',{$modal})");
                
            }else {
                $writer->writeHtml("Adept.Application.getController('{$this->getWindowId()}').show({$modal})");
            }
        }
    }
    
    public function getWindowId() 
    {
       return $this->getProperty('windowId');
    }
    
    public function setWindowId($windowId) 
    {
       $this->setProperty('windowId', $windowId);
    }
    
    public function isCenter() 
    {
       return $this->getProperty('center');
    }
    
    public function setCenter($center) 
    {
       $this->setProperty('center', $center);
    }
    
    
    public function isModal() 
    {
       return $this->getProperty('modal');
    }
    
    public function setModal($modal) 
    {
       $this->setProperty('modal', $modal);
    }
    
    public function getPlacement() 
    {
         return $this->getProperty('placement');
    }
    
    public function setPlacement($placement)
    {
         $this->setProperty('placement', $placement);
    }
    	
    


           
}