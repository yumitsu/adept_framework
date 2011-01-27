<?php

abstract class Adept_ImageKit_Provider
{
    
    protected $container;
    
    /**
     * @return Adept_ImageKit_Provider
     */
    abstract public function createImageContainer($fileName, $type);
    
    /**
     * @return Adept_ImageKit_Provider
     */
    abstract public function watermark($watermark, $left = 0, $top = 0, $opacity = 0);
    
     /**
     * @return Adept_ImageKit_Provider
     */
    abstract public function resize($width = 0, $height = 0, $type = Adept_ImageKit_ResizeType::RESIZE_BOTH, $algorithm = Adept_ImageKit_ResizeType::RESIZE_ALGORITHM_MIN);
    
     /**
     * @return Adept_ImageKit_Provider
     */
    abstract public function resizeWidth($width,$type = Adept_ImageKit_ResizeType::RESIZE_BOTH, $algorithm = Adept_ImageKit_ResizeType::RESIZE_ALGORITHM_MIN);
    
    /**
     * @return Adept_ImageKit_Provider
     */
    abstract public function resizeHeight($height, $type = Adept_ImageKit_ResizeType::RESIZE_BOTH, $algorithm = Adept_ImageKit_ResizeType::RESIZE_ALGORITHM_MIN);
    
    /**
    * @return Adept_ImageKit_Provider
     */
    abstract public function colorSpace($space = Adept_ImageKit_ColorSpace::COLORSPACE_GREY);
    
    /**
    * @return Adept_ImageKit_Provider
     */
    abstract public function crop($left, $top, $width, $height);
    
    /**
    * @return Adept_ImageKit_Provider
     */
    abstract public function cropThumbnail($width, $height);
    
    /**
    * @return Adept_ImageKit_Provider
     */
    abstract public function sharpen($amount = 14.0);
    
    public function addFilter($name, $class)
    {
        $this->filters[$name] = $class;
    }
    
    /**
     * Enter description here...
     *
     * @param unknown_type $filterName
     * @param unknown_type $parameters
     * @return Adept_ImageKit_Filter
     */
    public function createFilter($filterName, $parameters = array())
    {
        if (!isset($this->filters[$filterName])){
            throw new Adept_Exception_IllegalArgument("Unsupported filter {$filterName}");
        }
        $class = $this->filters[$filterName];
        return new $class($parameters);
        
    }
    
    function load($fileName, $type = '')
    {
        $this->createImageContainer($fileName, $type);
        return $this;
    }
    
    public function save($fileName, $quality = 90)
    {
    	$this->getContainer()->save($fileName, $quality);
    	return $this;
    }
    
    /**
     * @return Adept_ImageKit_Gd_Container
     */
    public function getContainer() 
    {
       return $this->container;
    }
    
    public function setContainer($container) 
    {
       $this->container =  $container;
    }
    
    
    
    
    
}

