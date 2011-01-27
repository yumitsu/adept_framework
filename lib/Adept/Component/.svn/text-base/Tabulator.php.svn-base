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

class Adept_Component_Tabulator extends Adept_Component_AbstractControl  
{
    const SEPARATOR_FACET = 'separator';
    const SPACETAB_FACET = 'spaceTab';
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription("height");
        $this->addPropertyDescription("width");
        $this->addPropertyDescription("selected", array(self::CAP_PERSISTENT));
        $this->addPropertyDescription("cssPrefix", array(), 'a');
    }
    
    public function defineBrowserEvents()
    {
        return array();
    }
    
    public function getTabItems()
    {
        return $this->findChildrenByClass('Adept_Component_TabItem', false);
    }
    
    public function hasRenderer()
    {
        return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Tabulator';
    }    
    
   // Properies----------------------------------------------------------------
   
    public function getCssPrefix() 
    {
       return $this->getProperty('cssPrefix');
    }
    
    public function setCssPrefix($cssPrefix) 
    {
       $this->setProperty('cssPrefix', $cssPrefix);
    }
    
    public function getWidth() 
    {
       return $this->getProperty('width');
    }
    
    public function setWidth($width) 
    {
       $this->setProperty('width', $width);
    }
    
    public function getHeight() 
    {
       return $this->getProperty('height');
    }
    
    public function setHeight($height) 
    {
       $this->setProperty('height', $height);
    }
    
    public function getSelected() 
    {
       return $this->getProperty('selected');
    }
    
    public function setSelected($selected) 
    {
       $this->setProperty('selected', $selected);
    }

}