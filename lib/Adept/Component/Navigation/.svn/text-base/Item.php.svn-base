<?php

class Adept_Component_Navigation_Item extends Adept_Component_AbstractNavigationItem
{

    protected $patternMatched = null;
    
    const TITLE_FACET = 'title';

    protected function defineProperties()
    {
    	parent::defineProperties();

    	$this->addPropertyDescription('selectedClass', array(), 'selected');
    	$this->addPropertyDescription('selectedStyle', array(), null);
    	$this->addPropertyDescription('disabledClass', array(), 'disabled');
    	$this->addPropertyDescription('disabledStyle', array(), null);
        $this->addPropertyDescription('visitedClass', array(), 'visited');
        $this->addPropertyDescription('visitedStyle', array(), null);
    	
        $this->addPropertyDescription('href', array(), null);
        $this->addPropertyDescription('pattern', array(), null);
        
    	$this->addPropertyDescription('selected', array(), null);
    	$this->addPropertyDescription('pattern', array(), null);
    	$this->addPropertyDescription('visited', array(self::CAP_PERSISTENT), false);
    }
    
    public function hasRenderer()
    {
        return false;
    }

    protected function checkPattern()
    {
    	$pattern = $this->getPattern();
    	if ($pattern === null) {
    	    $pattern = $this->getHref();
    	}
    	
    	if ($pattern === null) {
    	    return false;
    	}
    	
    	$url = $this->getContext()->getRequest()->getUrl()->getPath();
    	if ($this->patternMatched === null) {
             $this->patternMatched = preg_match('~^' . $pattern . '$~', $url);
    	}
    	return $this->patternMatched;
    }
    
    /**
     * @return Adept_Component_Facet
     */
    public function getTitleFacet()
    {
    	return $this->getFacet(self::TITLE_FACET);
    }    
    
    // Properties --------------------------------------------------------------

    public function getDisabledClass() 
    {
        return $this->getProperty('disabledClass');
    }
    
    public function setDisabledClass($disabledClass) 
    {
        $this->setProperty('disabledClass', $disabledClass);
    }
    
    public function getDisabledStyle() 
    {
        return $this->getProperty('disabledStyle');
    }
    
    public function setDisabledStyle($disabledStyle) 
    {
        $this->setProperty('disabledStyle', $disabledStyle);
    }
    
    public function getHref() 
    {
        return $this->getProperty('href');
    }
    
    public function setHref($href) 
    {
        $this->setProperty('href', $href);
    }
    
    public function isSelected() 
    {
        $selected = $this->getProperty('selected');
        if (null === $selected) {
            return $this->checkPattern();
        }
        return $selected;
    }
    
    public function setSelected($selected) 
    {
        $this->setProperty('selected', $selected);
    }
    
    public function getSelectedClass() 
    {
        return $this->getProperty('selectedClass');
    }
    
    public function setSelectedClass($selectedClass) 
    {
        $this->setProperty('selectedClass', $selectedClass);
    }

    public function getSelectedStyle() 
    {
        return $this->getProperty('selectedStyle');
    }
    
    public function setSelectedStyle($selectedStyle) 
    {
        $this->setProperty('selectedStyle', $selectedStyle);
    }

    public function getPattern() 
    {
        return $this->getProperty('pattern');
    }
    
    public function setPattern($pattern) 
    {
        $this->setProperty('pattern', $pattern);
    }
    
    public function isVisited() 
    {
        return $this->getProperty('visited');
    }
    
    public function setVisited($visited)
    {
        $this->setProperty('visited', $visited);
    }
    
    public function getVisitedClass() 
    {
        return $this->getProperty('visitedClass');
    }
    
    public function setVisitedClass($visitedClass) 
    {
        $this->setProperty('visitedClass', $visitedClass);
    }

    public function getVisitedStyle() 
    {
        return $this->getProperty('visitedStyle');
    }
    
    public function setVisitedStyle($visitedStyle) 
    {
        $this->setProperty('visitedStyle', $visitedStyle);
    }
        
}
