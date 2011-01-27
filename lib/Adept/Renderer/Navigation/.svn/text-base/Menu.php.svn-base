<?php

class Adept_Renderer_Navigation_Menu extends Adept_Renderer_Base 
{
    
    protected $_defaultItemClass = 'navigation-item';
    
    /**
     * @param Adept_Component_Navigation_Menu $component
     * @param Adept_Component_Navigation_Item $item
     */
    protected function renderItemContents($component, $item)
    {
        $writer = $this->getWriter();
        
        $titleFacet = $item->getTitleFacet();
        
        $href = $item->getHref();
        if ($href != null && !$item->isSelected() && !$item->isDisabled()) {
            $writer->writeTag('a', array('href' => $href));
            
            if ($titleFacet) {
                $titleFacet->render();
            } else {
                $writer->writeText($item->getTitle());
            }
            
            $writer->writeTag('/a');
        } else {
            if ($titleFacet) {
                $titleFacet->render();
            } else {
                $writer->writeText($item->getTitle());
            }
        }
    }
    
    
    /**
     * @param Adept_Component_Navigation_Menu $component
     * @param Adept_Component_Navigation_Item $item
     */
    protected function renderItem($component, $item)
    {
        $writer = $this->getWriter();
        
    	if (!$item->isRendered()) {
    	    return ;
    	}
    	
    	$class = $item->getCssClass();
    	$style = $item->getCssStyle();
    	
    	if ($class === null) {
    	    $class = $this->_defaultItemClass;
    	}
    	
        if ($item->isSelected()) {
            $class .= ' ' . $item->getSelectedClass();
            $style .= ' ' . $item->getSelectedStyle();
        } 
        
        if ($item->isDisabled()) {
            $class .= ' ' . $item->getDisabledClass();
            $style .= ' ' . $item->getDisabledStyle();
        }
        
        if ($item->isVisited()) {
            $class .= ' ' . $item->getVisitedClass();
            $style .= ' ' . $item->getVisitedStyle();
        }
    	
        if (trim($class) == '') {
            $class = null;
        }
        
        if (trim($style) == '') {
            $style = null;
        }

        $writer->writeTag('li', array('class' => $class, 'style' => $style));
        
        $this->renderItemContents($component, $item);
    	
    	$writer->writeTag('/li');
    }
    
    /**
     * @param Adept_Component_Navigation_Menu $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        $writer->writeTag('ul', array(
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
        ));
    }
    
    /**
     * @param Adept_Component_Navigation_Menu $component
     */
    public function renderChildren($component)
    {
    	$items = $component->getNavigationItems();
        foreach ($items as $item) {
            $this->renderItem($component, $item);
        }
    }
    
    /**
     * @param Adept_Component_Navigation_Menu $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeTag('/ul');        
    }
    
}

