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

class Adept_Component_Html_Image extends Adept_Component_AbstractControl
{

    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('align', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('hspace', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('ismap', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('lowSrc', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('vspace', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('useMap', array(self::CAP_PERSISTENT), false);
        $this->addPropertyDescription('src', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('width', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('height', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('border', array(self::CAP_PERSISTENT), null);
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Html_Image';
    }         
    
    public function defineBrowserEvents()
    {
        return array();
    }
    
    public function getHspace() 
    {
        return $this->getProperty('hspace');
    }
    
    public function setHspace($hspace)
    {
        $this->setProperty('hspace', $hspace);
    }
    
    public function getIsmap() 
    {
        return $this->getProperty('ismap');
    }
    
    public function setIsmap($ismap)
    {
        $this->setProperty('ismap', $ismap);
    }

    public function getLowSrc() 
    {
        return $this->getProperty('lowSrc');
    }
    
    public function setLowSrc($lowSrc)
    {
        $this->setProperty('lowSrc', $lowSrc);
    }
    
    public function getVspace() 
    {
        return $this->getProperty('vspace');
    }
    
    public function setVspace($vspace)
    {
        $this->setProperty('vspace', $vspace);
    }
    
    public function getUseMap() 
    {
        return $this->getProperty('useMap');
    }
    
    public function setUseMap($useMap)
    {
        $this->setProperty('useMap', $useMap);
    }

    public function getAlign() 
    {
        return $this->getProperty('align');
    }
    
    public function setAlign($align)
    {
        $this->setProperty('align', $align);
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

    public function getHeight() 
    {
        return $this->getProperty('height');
    }
    
    public function setHeight($height)
    {
        $this->setProperty('height', $height);
    }

    public function getBorder() 
    {
        return $this->getProperty('border');
    }
    
    public function setBorder($border)
    {
        $this->setProperty('border', $border);
    }
    
    public function hasRenderer()
    {
        return true;
    }
    
}