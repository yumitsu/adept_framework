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

class Adept_Component_Grid_Column extends Adept_Component_AbstractPersistent 
{

    protected function defineProperties()
    {
    	parent::defineProperties();
    	$this->addPropertyDescription('cssClass');
    	$this->addPropertyDescription('cssStyle');
    	$this->addPropertyDescription('title');
    	$this->addPropertyDescription('titleClass');
    	$this->addPropertyDescription('titleStyle');
    }
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Grid_Column';
    }

    public function renderTitle()
    {
        if ($this->hasRenderer()) {
            $this->getRenderer()->renderTitle($this);
        }
    }
    
    // Properties -------------------------------------------------------------
    
    public function getCssClass() 
    {
        return $this->getProperty('cssClass');
    }
    
    public function setCssClass($cssClass)
    {
        $this->setProperty('cssClass', $cssClass);
    }

    public function getCssStyle() 
    {
        return $this->getProperty('cssStyle');
    }
    
    public function setCssStyle($cssStyle)
    {
        $this->setProperty('cssStyle', $cssStyle);
    }
    
    public function getTitle() 
    {
        return $this->getProperty('title');
    }
    
    public function setTitle($title)
    {
        $this->setProperty('title', $title);
    }
    
    public function getTitleClass() 
    {
        return $this->getProperty('titleClass');
    }
    
    public function setTitleClass($titleClass)
    {
        $this->setProperty('titleClass', $titleClass);
    }
    
    public function getTitleStyle() 
    {
        return $this->getProperty('titleStyle');
    }
    
    public function setTitleStyle($titleStyle)
    {
        $this->setProperty('titleStyle', $titleStyle);
    }
    
    public function hasRenderer()
    {
        return true;
    }
    
}