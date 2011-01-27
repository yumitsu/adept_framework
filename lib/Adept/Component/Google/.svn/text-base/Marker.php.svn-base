<?php

class Adept_Component_Google_Marker extends Adept_Component_AbstractPersistent 
{
    
    protected function defineProperties()
    {
    	parent::defineProperties();
    	$this->addPropertyDescription('persistent', array(), true);
    	$this->addPropertyDescription('changed', array(), false);
    	$this->addPropertyDescription('latitude', array(self::CAP_PERSISTENT), 53.18371600);
        $this->addPropertyDescription('longitude', array(self::CAP_PERSISTENT), 45.17715500);
        
        $this->addPropertyDescription('draggable', array(), true, self::TYPE_BOOL);
        $this->addPropertyDescription('removable', array(), true, self::TYPE_BOOL);
        $this->addPropertyDescription('icon');
        $this->addPropertyDescription('transparentIcon');
        $this->addPropertyDescription('title');
        $this->addPropertyDescription('description');
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Google_Marker';
    }         
    
    public function fillParameters($parameters)
    {
        
     	$this->setLatitude($parameters['latitude']);
    	$this->setLongitude($parameters['longitude']);
    	$this->setChanged(true);
//    	$this->setDraggable($parameters['draggable']);
    }
    
    public function toArray()
    {
    	$markerArray = array();
    	$markerArray['latitude'] = $this->getLatitude();
    	$markerArray['longitude'] = $this->getLongitude();
    	$markerArray['draggable'] = $this->isDraggable();
    	$markerArray['windowContent'] = $this->getWindowContent();
    	$markerArray['iconImage'] = $this->getIcon();
    	return $markerArray;
    }
    
    public function getWindowContent()
    {
        $windwContent = '';
        if ($this->getTitle()) {
            $windowContent = "<b>{$this->getTitle()}</b><br />"; 
        }
        if($this->getDescription()) {
            $windowContent .= "<div>" . nl2br($this->getDescription()) . "</div>";
        }
        
        return $windowContent;
    }
    
    public function remove()
    {
    	$this->getMap()->removeMarker($this);
    }
    
    /**
     * @return Adept_Component_Google_Map
     */
    public function getMap()
    {
    	return $this->findParentByClass("Adept_Component_Map_Google");
    }
    
    public function hasRenderer()
    {
    	return true;
    }
    
    // Properties---------------------------------------------------------------
    
    public function getIcon() 
    {
       return $this->getProperty('icon');
    }
    
    public function setIcon($icon) 
    {
       $this->setProperty('icon', $icon);
    }
    
    public function getTransparentIcon() 
    {
        return $this->getProperty('transparentIcon');
    }
    
    public function setTransparentIcon($transparentIcon) 
    {
        $this->setProperty('transparentIcon', $transparentIcon);
    }
    
    
    
    public function getTitle() 
    {
       return $this->getProperty('title');
    }
    
    public function setTitle($title) 
    {
       $this->setProperty('title', $title);
    }
    
    public function getLongitude() 
    {
       return $this->getProperty('longitude');
    }
    
    public function setLongitude($longitude) 
    {
       $this->setProperty('longitude', $longitude);
    }
    
    public function getLatitude() 
    {
       return $this->getProperty('latitude');
    }
    
    public function setLatitude($latitude) 
    {
       $this->setProperty('latitude', $latitude);
    }
    
    public function isDraggable() 
    {
       return $this->getProperty('draggable');
    }
    
    public function setDraggable($draggable) 
    {
       $this->setProperty('draggable', $draggable);
    }
    
    public function isRemovable() 
    {
        return $this->getProperty('removable');
    }
    
    public function setRemovable($removable) 
    {
        $this->setProperty('removable', $removable);
    }
    
    
    
    public function getDescription() 
    {
        return $this->getProperty('description');
    }
    
    public function setDescription($description) 
    {
        $this->setProperty('description', $description);
    }
    
    public function isChanged() 
    {
        return $this->getProperty('changed');
    }
    
    public function setChanged($changed) 
    {
        $this->setProperty('changed', $changed);
    }
    
}

