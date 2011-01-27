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

class Adept_Component_Base_Button extends Adept_Component_AbstractCommand implements Adept_Component_Focusable 
{

    const CLICK_EVENT = 'click';
    
    public function defineBrowserEvents()
    {
        return array();
    }
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('clicked', array(self::CAP_CLIENT), false);
        
        $this->addPropertyDescription('ajax', array(), false, self::TYPE_BOOL);
        $this->addPropertyDescription('accesskey', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('tabIndex', array(self::CAP_PERSISTENT), null, self::TYPE_INT);
    }

    // Events -----------------------------------------------------------------
    
    public function addClickListener($listener)
    {
        $this->addEventListener(self::CLICK_EVENT, $listener);
    }
    
    // Lifecycle phases -------------------------------------------------------

    public function invokeApplication()
    {
        if ($this->isClicked() && $this->isValid()) {            
            // Process action             
            $this->queueAction();
            // Process event handlers
            $this->queueEvent(new Adept_Event_Click($this));
        }
    }    
    
    public function isClicked()
    {
        return $this->getProperty('clicked');
    }
    
    public function setClicked($clicked)
    {
        $this->setProperty('clicked', $clicked);
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
    
    public function isAjax()
    {
        return $this->getProperty('ajax');
    }
    
    public function setAjax($ajax)
    {
        $this->setProperty('ajax', $ajax);
    }    
    
//    public function isForceServerSide() 
//     {
//         return $this->getProperty('forceServerSide');
//     }
//     
//     public function setForceServerSide($forceServerSide)
//     {
//         $this->setProperty('forceServerSide', $forceServerSide);
//     }
//        
    
     
}

