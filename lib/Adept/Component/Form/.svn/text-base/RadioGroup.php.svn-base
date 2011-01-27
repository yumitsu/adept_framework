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

class Adept_Component_Form_RadioGroup extends Adept_Component_Base_SelectInput 
{
    const VERTICAL_PLACEMENT = 'vertical';
    const HORIZONTAL_PLACEMENT = 'horizontal';
    const CUSTOM_PLACEMENT = 'custom';
    
    const LAYOUT_TABLE = 'table';
    const LAYOUT_UL = 'ul';
    const LAYOUT_OL = 'ol';

    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('placement', array(), self::VERTICAL_PLACEMENT);
        $this->addPropertyDescription('layout', array(), self::LAYOUT_TABLE);
        $this->addPropertyDescription('layoutCssClass');
        $this->addPropertyDescription('layoutCssStyle');
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form_RadioGroup';
    }    
    
    public function getPlacement() 
    {
        return $this->getProperty('placement');
    }
    
    public function setPlacement($placement)
    {
        $this->setProperty('placement', $placement);
    }
    
    public function getLayout() 
    {
        return $this->getProperty('layout');
    }
    
    public function setLayout($layout) 
    {
        $this->setProperty('layout', $layout);
    }
    
    public function getLayoutCssClass() 
    {
        return $this->getProperty('layoutCssClass');
    }
    
    public function setLayoutCssClass($layoutCssClass) 
    {
        $this->setProperty('layoutCssClass', $layoutCssClass);
    }
    
    public function getLayoutCssStyle() 
    {
        return $this->getProperty('layoutCssStyle');
    }
    
    public function setLayoutCssStyle($layoutCssStyle) 
    {
        $this->setProperty('layoutCssStyle', $layoutCssStyle);
    }
    
    public function defineBrowserEvents()
    {
        return array(
            Adept_Component_BrowserEvent::ON_CHANGE,
        );
    }    
    
    public function hasRenderer()
    {
        return true;
    }    
}
