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

class Adept_Component_Message_Item extends Adept_Component_AbstractBase 
{
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('for');
        $this->addPropertyDescription('group');
    }
    
    public function hasRenderer()
    {
        return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Message_Item';
    } 
        
    /**
     * Returns message assosiated with this component if any; otherwise returns null.
     * 
     * @return Adept_Message The information message.
     */
    public function getMessage()
    {
        $messageId = $this->getFor();
        if ($messageId == null) {
            $messageId = $this->getClientId(); 
        }
        $message = Adept_Context::getInstance()->getMessageSet()->getMessage($messageId);
        return $message;
    }
    
    
    public function getFor() 
    {
        return $this->getProperty('for');
    }
    
    public function setFor($for)
    {
        $this->setProperty('for', $for);
    }
    
    public function getGroup() 
    {
        return $this->getProperty('group');
    }
    
    public function setGroup($group) 
    {
        $this->setProperty('group', $group);
    }
    
    // Render attributes ------------------------------------------------------
    
    public function getErrorClass() 
    {
        return $this->getAttribute('errorClass');
    }
    
    public function setErrorClass($errorClass)
    {
        $this->setAttribute('errorClass', $errorClass);
    }
    
    public function getInformClass() 
    {
        return $this->getAttribute('informClass');
    }
    
    public function setInformClass($informClass)
    {
        $this->setAttribute('informClass', $informClass);
    }
    
    public function getWarningClass() 
    {
        return $this->getAttribute('warningClass');
    }
    
    public function setWarningClass($warningClass)
    {
        $this->setAttribute('warningClass', $warningClass);
    }
    
    public function getErrorStyle() 
    {
        return $this->getAttribute('errorStyle');
    }
    
    public function setErrorStyle($errorStyle)
    {
        $this->setAttribute('errorStyle', $errorStyle);
    }
    
    public function getInformStyle() 
    {
        return $this->getAttribute('informStyle');
    }
    
    public function setInformStyle($informStyle)
    {
        $this->setAttribute('informStyle', $informStyle);
    }

    public function getWarningStyle() 
    {
        return $this->getAttribute('warningStyle');
    }
    
    public function setWarningStyle($warningStyle)
    {
        $this->setAttribute('warningStyle', $warningStyle);
    }

}