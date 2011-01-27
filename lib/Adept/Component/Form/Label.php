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

class Adept_Component_Form_Label extends Adept_Component_AbstractControl  
{
  
    
    public function getForAsComponent()
    {
        $clientId = $this->getFor();
        if ($clientId !== null) {
            return $this->getRootView()->findChildByClientId($clientId);
        } 
        return null;
    }
    
    public function isErrorMode()
    {
        $forComponent = $this->getForAsComponent();
        
        if ($forComponent instanceof Adept_Component_AbstractInput) {
            return !$forComponent->isValid();
        } else {
            return false;
        }
    }
    
    public function defineBrowserEvents()
    {
        return array();
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form_Label';
    }    
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('for');
        $this->addPropertyDescription('errorCssClass', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('errorCssStyle', array(self::CAP_PERSISTENT), null);
    }
    
    // Properties -------------------------------------------------------------
    
    public function getFor() 
    {
        return $this->getProperty('for');
    }
    
    public function setFor($for)
    {
        if ($for instanceof Adept_Component_AbstractComponent) {
            $for = $for->getClientId();
        }
        $this->setProperty('for', $for);
    }
    
    // State properties -------------------------------------------------------
    
    public function getErrorCssClass() 
    {
        return $this->getProperty('errorCssClass');
    }
    
    public function setErrorCssClass($errorCssClass)
    {
        $this->setProperty('errorCssClass', $errorCssClass);
    }
    
    public function getErrorCssStyle() 
    {
        return $this->getProperty('errorCssStyle');
    }
    
    public function setErrorCssStyle($errorCssStyle)
    {
        $this->setProperty('errorCssStyle', $errorCssStyle);
    }
    
}