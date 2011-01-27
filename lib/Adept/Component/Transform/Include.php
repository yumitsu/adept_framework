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

class Adept_Component_Transform_Include extends Adept_Component_SubView  
    implements Adept_Component_NamingContainer 
{    
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('file');
        $this->addPropertyDescription('namingContainer', array(), false);
    }
    
    protected function includeTemplate()
    {
        try {
            $subView = Adept_ViewLoader::getInstance()->loadTemplate($this->getFile());
        } catch (Adept_Template_Exception $e) {
            throw new Adept_Component_Exception($e);
        }
        
        foreach ($subView->getChildren() as $child) {
            $this->addChild($child);
        }
    }
    
    public function init()
    {
        $this->includeTemplate();
    }
    
    protected function getParameters()
    {
        return $this->findChildByClass('Adept_Component_Transform_Parameter', false);
    }
       
    public function hasRenderer()
    {
        return false;
    }
    
    // Naming container --------------------------------------------------------
    
    public function getNamingContainerId()
    {
        if ($this->isNamingContainer()) {
            return $this->getClientId();
        } else {
            return null;
        }
    }
    
    public function isNamingContainer() 
    {
        return $this->getProperty('namingContainer', false);
    }
    
    public function setNamingContainer($namingContainer)
    {
        $this->setProperty('namingContainer', $namingContainer);
    }    
    
    // Properties --------------------------------------------------------------
    
    public function getFile() 
    {
        return $this->getProperty('file');
    }
    
    public function setFile($file) 
    {
        $this->setProperty('file', $file);
    }
    
}
