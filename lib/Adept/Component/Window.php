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

class Adept_Component_Window extends Adept_Component_AbstractPersistent
    implements Adept_Component_DomContainer
{
    const SHOW_EVENT = 'show';

    public function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('top', array(), 100);
        $this->addPropertyDescription('left', array(), 100);
        $this->addPropertyDescription('width', array(), 400);
        $this->addPropertyDescription('height', array(), 200);
        $this->addPropertyDescription('title');
        $this->addPropertyDescription('cssPrefix', array(), 'a');
        $this->addPropertyDescription('cssClass', array());
        $this->addPropertyDescription('ajaxLoading', array(), false);
        $this->addPropertyDescription('forceUpadte', array(), false);
        $this->addPropertyDescription('closable', array(), true);
        $this->addPropertyDescription('draggable', array(), false);
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Window_Base';
    }        
    
    public function hasRenderer()
    {
        
    	return true;
    }
    
    
    
    public function getDomContainerId()
    {
        return $this->getClientId() . '_contentHolder';
    }
    
    public  function getRealCssClassName($cssClass)
    {
        return $this->getCssPrefix() . '-' .  $cssClass;
    }
    
    /**
     * Show window
     *
     * @param boolen $modal flag for modal mode
     */
    public function show($modal = false, $updateContent = true)
    {
        if ($updateContent){
            $this->markDirty(Adept_Component_DirtyState::CHILDREN);
        }
        Adept_Context::getInstance()->getAjaxChannel()->invoke($this->getClientId(), 'show', array($modal, true));
    }
    
    /**
     * Show window on center screen
     *
     * @param boolen $modal flag for modal mode
     */
    public function showCenter($modal = false, $updateContent = true)
    {
        if ($updateContent){
                $this->markDirty(Adept_Component_DirtyState::CHILDREN);
            }
        Adept_Context::getInstance()->getAjaxChannel()->invoke($this->getClientId(), 'showCenter', array($modal, true));
    }
    
    public function hide()
    {
        Adept_Context::getInstance()->getAjaxChannel()->invoke($this->getClientId(), 'hide');
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
    
    public function getTop() 
    {
        return $this->getProperty('top');
    }
    
    public function setTop($top) 
    {
        $this->setProperty('top', $top);
    }
    
    public function getLeft() 
    {
        return $this->getProperty('left');
    }
    
    public function setLeft($left) 
    {
        $this->setProperty('left', $left);
    }
    
    public function getWidth() 
    {
        return $this->getProperty('width');
    }
    
    public function setWidth($width) 
    {
        $this->setProperty('width', $width);
    }
    public function getHeight() 
    {
        return $this->getProperty('height');
    }
    
    public function setHeight($height) 
    {
        $this->setProperty('height', $height);
    }
    public function getCssPrefix() 
    {
       return $this->getProperty('cssPrefix');
    }
    
    public function setCssPrefix($cssPrefix) 
    {
        $this->setProperty('cssPrefix', $cssPrefix);
    }
    
    public function isAjaxLoading() 
    {
        return $this->getProperty('ajaxLoading');
    }
    
    public function setAjaxLoading($ajaxLoading) 
    {
        $this->setProperty('ajaxLoading', $ajaxLoading);
    }
    
    public function isForceUpdate() 
    {
        return $this->getProperty('fourceUpdate');
    }
    
    public function setForceUpdate($fourceUpdate) 
    {
        $this->setProperty('fourceUpdate', $fourceUpdate);
    }
    
    public function isClosable() 
    {
        return $this->getProperty('closable');
    }
    
    public function setClosable($closable) 
    {
        $this->setProperty('closable', $closable);
    }
    
    public function isDraggable() 
    {
        return $this->getProperty('draggable');
    }
    
    public function setDraggable($draggable) 
    {
        $this->setProperty('draggable', $draggable);
    }
    
    public function getCssClass() 
    {
        return $this->getProperty('cssClass');
    }
    
    public function setCssClass($cssClass) 
    {
        $this->setProperty('cssClass', $cssClass);
    }
    
}