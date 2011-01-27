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

/**
 * Comoponent MessageList
 * 
 * Suppoerted render attributes:
 * 
 * - errorStlye
 * 
 * TODO
 *
 */
class Adept_Component_Message_List extends Adept_Component_AbstractControl 
{

    protected $group = null;

    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('group');
    }
    /**
     * Returns messages assosiated with this component.
     *
     * @return Adept_Map
     */
    public function getMessages() 
    {
        $group = $this->getGroup();
        if (null === $group) {
            $form = $this->findParentByClass('Adept_Component_Form');
            if (null !== $form) {
                $group = $form->getClientId();
            }
        }
        $messages = $this->getContext()->getMessageSet()->getMessages($group);
        return $messages;
    }
    
    public function getGroup() 
    {
        return $this->getProperty('group');
    }
    
    public function setGroup($group) 
    {
        $this->setProperty('group', $group);
    }
    
    public function getCssClass() 
    {
        return $this->getProperty('cssClass');
    }
    
    public function setCssClass($cssClass)
    {
        $this->setProperty('cssClass', $cssClass);
    }
    
    public function getCssStyle() 
    {
        return $this->getProperty('cssStyle');
    }
    
    public function setCssStyle($cssStyle)
    {
        $this->setProperty('cssStyle', $cssStyle);
    }
    
    public function hasRenderer()
    {
        return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Message_List';
    } 

    // Render attributes ------------------------------------------------------
    
    public function getDefaultClass() 
    {
        return $this->getAttribute('defaultClass');
    }
    
    public function setDefaultClass($defaultClass)
    {
        $this->setAttribute('defaultClass', $defaultClass);
    }
    
    public function getDefaultStyle() 
    {
        return $this->getAttribute('defaultStyle');
    }
    
    public function setDefaultStyle($defaultStyle)
    {
        $this->setAttribute('defaultStyle', $defaultStyle);
    }
    
    public function getHintClass() 
    {
        return $this->getAttribute('hintClass');
    }
    
    public function setHintClass($hintClass)
    {
        $this->setAttribute('hintClass', $hintClass);
    }
    
    public function getHintStyle() 
    {
        return $this->getAttribute('hintStyle');
    }
    
    public function setHintStyle($hintStyle)
    {
        $this->setAttribute('hintStyle', $hintStyle);
    }
    
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
