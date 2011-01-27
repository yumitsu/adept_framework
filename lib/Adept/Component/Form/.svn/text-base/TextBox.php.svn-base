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
    
class Adept_Component_Form_TextBox extends Adept_Component_Base_TextInput  
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function defineBrowserEvents()
    {
        return array(
            Adept_Component_BrowserEvent::ON_CHANGE,
            Adept_Component_BrowserEvent::ON_KEY_UP,
            Adept_Component_BrowserEvent::ON_KEY_DOWN,
            Adept_Component_BrowserEvent::ON_KEY_PRESS,
        );
    }
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('maxLength', array(self::CAP_PERSISTENT), null, self::TYPE_INT);
        $this->addPropertyDescription('size', array(self::CAP_PERSISTENT), null, self::TYPE_INT);
        $this->addPropertyDescription('readOnly',  array(self::CAP_PERSISTENT), false, self::TYPE_BOOL);
        $this->addPropertyDescription('validator');
    }

    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form_TextBox';
    }    
    
    public function getMaxLength() 
    {
        return $this->getProperty('maxLength');
    }
    
    public function setMaxLength($maxLength)
    {
        $this->setProperty('maxLength', $maxLength);
    }
    
    public function isReadOnly() 
    {
        return $this->getProperty('readOnly', false);
    }
    
    public function setReadOnly($readOnly)
    {
        $this->setProperty('readOnly', $readOnly);
    }
    
    public function getSize() 
    {
        return $this->getProperty('size');
    }
    
    public function setSize($size)
    {
        $this->setProperty('size', $size);
    }
}
