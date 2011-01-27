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

class Adept_Component_Timer extends Adept_Component_AbstractCommand 
{
    
    const TIMER_EVENT = 'timer';
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('interval', array(), 1);
        $this->addPropertyDescription('timeComes', array(), false);
        $this->addPropertyDescription('partition');
        
    }
    
    public function defineBrowserEvents()
    {
        return array();
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Timer';
    }        
    
    public function addTimerListener($listener)
    {
        $this->addEventListener(self::TIMER_EVENT, $listener);
    }
    
    public function invokeApplication()
    {
        if ($this->isTimeComes()) {
            $this->queueEvent(new Adept_Event_Timer($this));
            $this->queueAction();
        }
    }
    
    // Properties --------------------------------------------------------------

    public function isTimeComes() 
    {
        return $this->getProperty('timeComes');
    }
    
    public function setTimeComes($timeComes) 
    {
        $this->setProperty('timeComes', $timeComes);
    }
    
    public function getInterval() 
    {
        return $this->getProperty('interval');
    }
    
    public function setInterval($interval) 
    {
        $this->setProperty('interval', $interval);
    }
    
    public function hasRenderer()
    {
        return true;
    }
    
    public function getPartition() 
    {
        return $this->getProperty('partition');
    }
    
    public function setPartition($partition) 
    {
        $this->setProperty('partition', $partition);
    }
    
    
}