<?php

class Adept_Component_Google_Map extends Adept_Component_AbstractPersistent  
    implements  Adept_Component_DomContainer
{
    const MAP_CONTROL_NONE = 'none';
    const MAP_CONTROL_SMALL = 'small';
    const MAP_CONTROL_LARGE = 'large';
    
    const G_NORMAL_MAP = 'G_NORMAL_MAP';  
    const G_SATELLITE_MAP = 'G_SATELLITE_MAP';   
    const G_HYBRID_MAP = 'G_HYBRID_MAP';   
    const G_PHYSICAL_MAP = 'G_PHYSICAL_MAP';
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('sinchronize', array(), false);
        $this->addPropertyDescription('persistent', array(), true);
        $this->addPropertyDescription('width', array(), 500);
        $this->addPropertyDescription('height', array(), 300);
        
        $this->addPropertyDescription('key');
        
        $this->addPropertyDescription('mapControl', array(), self::MAP_CONTROL_SMALL);
        $this->addPropertyDescription('typeControl', array(), false, self::TYPE_BOOL);
        
        $this->addPropertyDescription('type', array(), self::G_NORMAL_MAP, self::TYPE_STRING);
        
        $this->addPropertyDescription('latitude', array(), 53.18371600);
        $this->addPropertyDescription('longitude', array(), 45.17715500);
        $this->addPropertyDescription('zoom', array(), 10);
        
        $this->addPropertyDescription('draggable', array(), true);
        
        $this->addPropertyDescription('scrollingZoom', array(), true);
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Google_Map';
    }         
    
    public function invokeApplication()
    {
        if ($this->isSinchronize()) {            
            // Process action             
            // Process event handlers
            $this->queueEvent(new Adept_Event_Abstract('sinchronize', $this));
        }
    }
      
    public function getDomContainerId()
    {
        return $this->getClientId();
    }
    
    public function renderAjax()
    {
        if ($this->getDirtyState() !== Adept_Component_DirtyState::NOTHING) {
            $this->getRenderer()->renderAjax($this);
        }
    }
    
    public function removeMarker($marker)
    {
        $this->getChildren()->remove($this->getChildren()->indexOf($marker));
    }
    
    public function addMarker($marker) {
    	$this->addChild($marker);
    }
    
    
    public function fillParameters($parameters)
    {
    	foreach ($parameters as $id =>$data){
    	    $marker = $this->findChildByClientId($id);
    	    if (($marker instanceof Adept_Component_Google_Marker)){
    	       $marker->fillParameters(Adept_Json::decode($data));  
    	    }
    	}
    }
    
    public function toArray()
    {
    	$markersArray = array();
    	foreach ($this->getMarkers() as $marker) {
    		$markersArray[$marker->getClientId()] = $marker->toArray();
    	}
    	return $markersArray;
    }

    public function hasRenderer()
    {
    	return true;
    }
    
    public function getMarkers()
    {
    	return $this->findChildrenByClass('Adept_Component_Google_Marker' ,false);
    }
    
    // Properies----------------------------------------------------------------
    
    public function isScrollingZoom() 
    {
       return $this->getProperty('scrollingZoom');
    }
    
    public function setScrollingZoom($scrollingZoom) 
    {
       $this->setProperty('scrollingZoom', $scrollingZoom);
    }

    public function isDraggable() 
    {
       return $this->getProperty('draggable');
    }
    
    public function setDraggable($draggable) 
    {
       $this->setProperty('draggable', $draggable);
    }
    
    public function getZoom() 
    {
       return $this->getProperty('zoom');
    }
    
    public function setZoom($zoom) 
    {
       $this->setProperty('zoom', $zoom);
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
    
    public function getKey() 
    {
       return $this->getProperty('key');
    }
    
    public function setKey($key) 
    {
       $this->setProperty('key', $key);
    }
    
    public function getMapControl() 
    {
       return $this->getProperty('mapControl');
    }
    
    public function setMapControl($mapControl) 
    {
       $this->setProperty('mapControl', $mapControl);
    }
    
    public function isTypeControl() 
    {
       return $this->getProperty('typeControl');
    }
    
    public function setTypeControl($typeControl) 
    {
       $this->setProperty('typeControl', $typeControl);
    }
    
    public function getType() 
    {
       return $this->getProperty('type');
    }
    
    public function setType($type) 
    {
       $this->setProperty('type', $type);
    }
    
    public function isSinchronize() 
    {
        return $this->getProperty('sinchronize');
    }
    
    public function setSinchronize($sinchronize) 
    {
        $this->setProperty('sinchronize', $sinchronize);
    }
    
    
}

