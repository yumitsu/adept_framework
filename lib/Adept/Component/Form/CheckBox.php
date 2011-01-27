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

class Adept_Component_Form_CheckBox extends Adept_Component_AbstractInput implements Adept_Component_Focusable 
{

    public function defineBrowserEvents()
    {
        return array(
            Adept_Component_BrowserEvent::ON_CHANGE,
            Adept_Component_BrowserEvent::ON_CLICK,
        );
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form_CheckBox';
    }    
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('checkedValue', array(), '1');
        $this->addPropertyDescription('label', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('accesskey', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('tabIndex', array(self::CAP_PERSISTENT), null);
    }
    
    public function getLabel() 
    {
        return $this->getProperty('label');
    }
    
    public function setLabel($label)
    {
        $this->setProperty('label', $label);
    }
    
    public function isChecked()
    {
        return (boolean) $this->getValue();
    }

    public function setChecked($checked)
    {
        $this->setValue($checked);        
//        if ($checked) {
//            $this->setValue($this->getCheckedValue());
//        } else {
//            $this->resetValue();
//        }
    }
    
    public function getCheckedValue() 
    {
        return $this->getProperty('checkedValue');
    }
    
    public function setCheckedValue($checkedValue)
    {
        $this->setProperty('checkedValue', $checkedValue);
    }
    
    // ------------------------------------------------------------------------
    
    // Focusable --------------------------------------------------------------
    
    public function getAccessKey() 
    {
        return $this->getProperty('accesskey');
    }
    
    public function setAccessKey($accesskey)
    {
        $this->setProperty('accesskey', $accesskey);
    }
    
    public function getTabIndex() 
    {
        return $this->getProperty('tabIndex');
    }
    
    public function setTabIndex($tabIndex)
    {
        $this->setProperty('tabIndex', $tabIndex);
    }    

}