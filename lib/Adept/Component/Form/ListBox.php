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

class Adept_Component_Form_ListBox extends Adept_Component_Base_SelectInput 
{

    public function defineBrowserEvents()
    {
        return array(
            Adept_Component_BrowserEvent::ON_CHANGE
        );
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form_ListBox';
    }    
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('size');
        $this->addPropertyDescription('multiple', array(), false);
             
    }
    
    public function isMultiple() 
    {
        return $this->getProperty('multiple');
    }
    
    public function setMultiple($multiple)
    {
        $this->setProperty('multiple', $multiple);
    }

    public function getSize() 
    {
        return $this->getProperty('size');
    }
    
    public function setSize($size)
    {
        $this->setProperty('size', $size);
    }

    public function hasRenderer()
    {
        return true;
    }
    
}
