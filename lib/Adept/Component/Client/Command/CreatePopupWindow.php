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

class Adept_Component_Client_Command_CreatePopupWindow extends Adept_Component_Client_Command_Base
{
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('windowId');
        $this->addPropertyDescription('pageUrl');
        $this->addPropertyDescription('scrollbars',array('yes','no'),'yes');
        $this->addPropertyDescription('resizable',array('yes','no'),'yes');
        $this->addPropertyDescription('centered',array('yes','no'),'yes');
        $this->addPropertyDescription('width', array(), 300);
        $this->addPropertyDescription('height', array(), 300);
        $this->addPropertyDescription('top', array(), 100);
        $this->addPropertyDescription('left', array(), 100);
    }
            
    public function hasRenderer()
    {
        return false;
    }
    
    public function renderBegin()
    {
        $writer = $this->getResponseWriter();
        
        $writer->writeHtml("window.open('" . $this->getPageUrl() . "','" 
           . $this->getWindowId() ."','scrollbars=" . $this->getScrollbars() . ",resizable=" 
           . $this->getResizable() .",width=" . $this->getWidth() . ",height=" . $this->getHeight() 
           . ",top='+" . $this->getTop() . "+'"
           . ",left='+" . $this->getLeft() . ");"
       );
    }
    
    public function getPageUrl() 
    {
       return $this->getProperty('pageUrl');
    }
    
    public function setPageUrl($pageUrl) 
    {
       $this->setProperty('pageUrl', $pageUrl);
    }
    
    public function getWindowId() 
    {
       return $this->getProperty('windowId');
    }
    
    public function setWindowId($windowId) 
    {
       $this->setProperty('windowId', $windowId);
    }
    
    public function getScrollbars() 
    {
       return $this->getProperty('scrollbars');
    }
    
    public function setScrollbars($scrollbars) 
    {
       $this->setProperty('scrollbars', $scrollbars);
    }
    
    public function getResizable() 
    {
       return $this->getProperty('resizable');
    }
    
    public function setResizable($resizable) 
    {
       $this->setProperty('resizable', $resizable);
    }
    
    public function getCentered() 
    {
       return $this->getProperty('centered');
    }
    
    public function setCentered($centered) 
    {
       $this->setProperty('centered', $centered);
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
    
    public function getTop()
    {
        if ($this->getCentered() == 'yes') {
            return '(screen.height - ' . $this->getHeight() . ')/2';
        } else {
            return $this->getProperty('top');
        }
    }
    
    public function setTop($top) 
    {
       $this->setProperty('top', $top);
    }
    
    public function getLeft()
    {
        if ($this->getCentered() == 'yes') {
            return '(screen.width - ' . $this->getWidth(). ')/2';
        } else {
            return $this->getProperty('left');
        }
    }
    
    public function setLeft($left) 
    {
       $this->setProperty('left', $left);
    }
    
}

