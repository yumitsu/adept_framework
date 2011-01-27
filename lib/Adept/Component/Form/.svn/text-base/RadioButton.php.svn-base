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

class Adept_Component_Form_RadioButton extends Adept_Component_AbstractInput implements Adept_Component_Focusable
{
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('label', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('group', array(), null);
        $this->addPropertyDescription('checkedValue', array(), '1');
    }
    
    public function defineBrowserEvents()
    {
        return array();
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form_RadioButton';
    }    
    
    public function getGroup() 
    {
        return $this->getProperty('group');
    }
    
    public function setGroup($group)
    {
        $this->setProperty('group', $group);
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
        return $this->getValue() == $this->getCheckedValue();
    }

    public function setChecked($checked)
    {
        if ($checked) {
            $this->setValue($this->getCheckedValue());
        } else {
            $this->resetValue();
        }
    }
    
    public function getCheckedValue() 
    {
        return $this->getProperty('checkedValue');
    }
    
    public function setCheckedValue($checkedValue)
    {
        $this->setProperty('checkedValue', $checkedValue);
    }   
    
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
