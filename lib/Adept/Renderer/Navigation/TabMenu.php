<?php

class Adept_Renderer_Navigation_TabMenu extends Adept_Renderer_Base 
{
    
    /**
     * @param Adept_Component_Navigation_TabMenu $component
     * @param Adept_Component_Navigation_Item $item
     */
    protected function renderTabItem($component, $item)
    {
    	$writer = $this->getWriter();
    	
    	if (!$item->isRendered()) {
    	    return ;
    	}
    	
    	$class = $item->getCssClass();
    	$style = $item->getCssStyle();
    	
    	if ($class === null) {
    	    $class = 'tabMenuItem';
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

        $titleFacet = $item->getTitleFacet();
        
        $writer->writeTag('li', array('class' => $class, 'style' => $style));
    	
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
    	
    	$writer->writeTag('/li');
    }
    
    /**
     * @param Adept_Component_Navigation_TabMenu $component
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
     * @param Adept_Component_Navigation_TabMenu $component
     */
    public function renderChildren($component)
    {
    	$items = $component->getNavigationItems();
        foreach ($items as $item) {
            $this->renderTabItem($component, $item);
        }
    }
    
    /**
     * @param Adept_Component_Navigation_TabMenu $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeTag('/ul');        
    }
    
}

