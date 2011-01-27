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

class Adept_Component_DateTime_DatePicker extends Adept_Component_Form_TextBox   
{
    
    const DEFAULT_DATE_FORMAT = '%d.%m.%Y';

    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('buttonClass');
        $this->addPropertyDescription('buttonStyle');
        $this->addPropertyDescription('buttonTitle');
        $this->addPropertyDescription('dateFormat', array(), self::DEFAULT_DATE_FORMAT);
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_DateTime_DatePicker';
    }        
    
    public function getButtonClass() 
    {
        return $this->getProperty('buttonClass');
    }
    
    public function setButtonClass($buttonClass) 
    {
        $this->setProperty('buttonClass', $buttonClass);
    }
    
    public function getButtonStyle() 
    {
        return $this->getProperty('buttonStyle');
    }
    
    public function setButtonStyle($buttonStyle) 
    {
        $this->setProperty('buttonStyle', $buttonStyle);
    }
    
    public function getButtonTitle() 
    {
        return $this->getProperty('buttonTitle');
    }
    
    public function setButtonTitle($buttonTitle) 
    {
        $this->setProperty('buttonTitle', $buttonTitle);
    }
    
    public function getDateFormat() 
    {
        return $this->getProperty('dateFormat');
    }
    
    public function setDateFormat($dateFormat) 
    {
        $this->setProperty('dateFormat', $dateFormat);
    }
    
}