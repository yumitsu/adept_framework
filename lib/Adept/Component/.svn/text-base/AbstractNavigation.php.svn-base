<?php

class Adept_Component_AbstractNavigation extends Adept_Component_AbstractCommand
{
    
    const NAVIGATION_ITEM_CLASS = 'Adept_Component_AbstractNavigationItem';
    
    /**
     * @return Adept_Component_AbstractNavigationItem
     */
    protected function createNavigationItem()
    {
        return new Adept_Component_Navigation_Item();
    }
    
    public function addNavigationItem()
    {
        $item = $this->createNavigationItem();
    	$this->addChild($item);
    	return $item;
    }
    
    /**
     * @return array
     */
    public function getNavigationItems()
    {
    	return $this->findChildrenByClass(self::NAVIGATION_ITEM_CLASS);
    }
    
    public function hasRenderer()
    {
    	return false;
    }
    
}