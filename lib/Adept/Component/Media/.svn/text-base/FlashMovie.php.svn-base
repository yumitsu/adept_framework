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

class Adept_Component_Media_FlashMovie extends Adept_Component_AbstractBase 
{
    
    public function defineProperties()
    {
    	parent::defineProperties();
    	$this->addPropertyDescription('align');
        $this->addPropertyDescription('height', array(), 300);
    	$this->addPropertyDescription('src');
    	$this->addPropertyDescription('width', array(), 400);
    	$this->addPropertyDescription('bgcolor');
    	$this->addPropertyDescription('flashvars');
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Media_FlashMovie';
    }         
    
    public function hasRenderer()
    {
        return true;
    }
    
    // Properties
    
    public function getAlign() 
    {
        return $this->getProperty('align');
    }
    
    public function setAlign($align)
    {
        $this->setProperty('align', $align);
    }
    
    public function getBgcolor() 
    {
        return $this->getProperty('bgcolor');
    }
    
    public function setBgcolor($bgcolor)
    {
        $this->setProperty('bgcolor', $bgcolor);
    }
    
    public function getFlashvars() 
    {
        return $this->getProperty('flashvars');
    }
    
    public function setFlashVars($flashvars)
    {
        $this->setProperty('flashvars', $flashvars);
    }

    public function getHeight() 
    {
        return $this->getProperty('height');
    }
    
    public function setHeight($height)
    {
        $this->setProperty('height', $height);
    }

    public function getSrc() 
    {
        return $this->getProperty('src');
    }
    
    public function setSrc($src)
    {
        $this->setProperty('src', $src);
    }

    public function getWidth() 
    {
        return $this->getProperty('width');
    }
    
    public function setWidth($width)
    {
        $this->setProperty('width', $width);
    }
}