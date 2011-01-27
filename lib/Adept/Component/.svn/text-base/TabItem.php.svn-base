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

class Adept_Component_TabItem extends Adept_Component_AbstractControl  
    implements Adept_Component_DomContainer 
{
    const SHOW_EVENT = 'show';

    public function getDomContainerId()
    {
        return $this->getClientId();
    }
    
    public function hasRenderer()
    {
        return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_TabItem';
    }        
    
    public function defineBrowserEvents()
    {
        return array();
    }  
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription("title");
        
        $this->addPropertyDescription("ajaxLoading", array(self::CAP_CLIENT), false);
        $this->addPropertyDescription("forceUpdate", array(self::CAP_CLIENT), false);
    }
    
    
    // Properties---------------------------------------------------------------
    
    
   public function getTitle() 
   {
      return $this->getProperty('title');
   }
   
   public function setTitle($title) 
   {
      $this->setProperty('title', $title);
   }
   
   public function isAjaxLoading() 
   {
      return $this->getProperty('ajaxLoading');
   }
   
   public function setAjaxLoading($ajaxLoading) 
   {
      $this->setProperty('ajaxLoading', $ajaxLoading);
   }
    
    public function getTabulator()
    {
        $tabulator = $this->findParentByClass('Adept_Component_Tabulator');
        if ($tabulator === null) {
            throw new Adept_Component_Exception('Cannot use TabItem outside Tabulator');
        }
        return $tabulator;
    }
    
    public function isSelected() 
    {
        return $this->getTabulator()->getSelected() == $this->getClientId();
    }

    public function setSelected($selected) 
    {
        if ($selected) {
            $this->getTabulator()->setSelected($this->getClientId());
        }
    }
    
    public function isForceUpdate() 
    {
       return $this->getProperty('forceUpdate');
    }
    
    public function setForceUpdate($forceUpdate) 
    {
       $this->setProperty('forceUpdate', $forceUpdate);
    }
    
}
