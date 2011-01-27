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

class Adept_Component_Form_ActionImage extends Adept_Component_Base_Button
{

    public function defineBrowserEvents()
    {
        return array(Adept_Component_BrowserEvent::ON_CLICK);
    }
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('src', array(), null);
        $this->addPropertyDescription('border', array(), null);
        $this->addPropertyDescription('align', array(), null);
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form_ActionImage';
    }

    /**
     * Returns true if js controller needed false otherwize
     *
     * @return boolean
     */
    public function isControllerNeeded()
    {
       return ($this->getAction() != null) || (count($this->listeners) != 0);
    }
    
    public function getSrc() 
    {
        return $this->getProperty('src');
    }
    
    public function setSrc($src)
    {
        $this->setProperty('src', $src);
    }
    
    public function getBorder() 
    {
        return $this->getProperty('border');
    }
    
    public function setBorder($border)
    {
        $this->setProperty('border', $border);
    }
    
    public function getAlign() 
    {
        return $this->getProperty('align');
    }
    
    public function setAlign($align)
    {
        $this->setProperty('align', $align);
    }
}