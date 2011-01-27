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

class Adept_Component_Tree_Item extends Adept_Component_AbstractBase
{
    
    protected $treeView;
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('icon', array());
        $this->addPropertyDescription('title', array());
        $this->addPropertyDescription('opened', array());    
    }
    
    public function hasRenderer()
    {
        return true;
    }

    /**
     * @return Adept_List
     */
    public function getChildItems()
    {
        return $this->findChildrenByClass('Adept_Component_Tree_Item', false);
    }

    public function getTreeView()
    {
        if ($this->treeView == null) {
           $this->treeView = $this->findParentByClass('Adept_Component_Tree_View');
           if ($this->treeView == null) {
                throw new Adept_Exception_IllegalState('TreeItem must be inside TreeView');
           }
        }
        return $this->treeView;
    }
    
    public function isEmpty()
    {
        return count($this->getChildItems()) == 0;
    }
    
    // Properties --------------------------------------------------------------
    
    public function getIcon() 
    {
        return $this->getProperty('icon');
    }
    
    public function setIcon($icon) 
    {
        $this->setProperty('icon', $icon);
    }
    
    public function getTitle() 
    {
        return $this->getProperty('title');
    }
    
    public function setTitle($title) 
    {
        $this->setProperty('title', $title);
    }
    
    public function getOpened() 
    {
        return $this->getProperty('opened');
    }
    
    public function setOpened($opened) 
    {
        $this->setProperty('opened', $opened);
    }
    
}