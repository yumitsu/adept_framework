<?php

class Adept_ImageKit_Gd_Provider extends Adept_ImageKit_Provider 
{

    protected $filters = array(
        'watermark' => 'Adept_ImageKit_Gd_Filter_WaterMark',
        'resize' => "Adept_ImageKit_Gd_Filter_Resize",
        'colorSpace' => 'Adept_ImageKit_Gd_Filter_ColorSpace',
        'crop' => 'Adept_ImageKit_Gd_Filter_Crop',
    	'cropThumbnail' => 'Adept_ImageKit_Gd_Filter_CropThumbnail',
    	'sharpen' => 'Adept_ImageKit_Gd_Filter_Sharpen',
    );

    public function createImageContainer($fileName, $type)
    {
        $this->setContainer(new Adept_ImageKit_Gd_Container());
        $this->getContainer()->load($fileName, $type);
    }
    
    public function watermark($watermark, $left = 0, $top = 0, $opacity = 0)
    {
        
        $params = array(
             'watermark' => $watermark,
             'left' => $left,
             'top' =>  $top,
             'opacity' => $opacity
         );
         
        $this->createFilter('watermark', $params)->apply($this->getContainer());
        return $this;
    }
    
    public function resize($width = 0, $height = 0, $type = Adept_ImageKit_ResizeType::RESIZE_BOTH, $algorithm = Adept_ImageKit_ResizeType::RESIZE_ALGORITHM_MIN)
    {
    	$params = array(
    	   'width' => $width,
    	   'height' => $height,
    	   'resisizeType' => $type,
    	   'algorithm' => $algorithm,
    	);
    	
    	$this->createFilter('resize', $params)->apply($this->getContainer());
    	return $this;
    }
    
    public function resizeWidth($width,$type = Adept_ImageKit_ResizeType::RESIZE_BOTH,$algorithm = Adept_ImageKit_ResizeType::RESIZE_ALGORITHM_MIN)
    {
    	$this->resize($width, 0, $type, $algorithm);
    	return $this;
    }
    
    public function resizeHeight($height, $type = Adept_ImageKit_ResizeType::RESIZE_BOTH, $algorithm = Adept_ImageKit_ResizeType::RESIZE_ALGORITHM_MIN)
    {
    	$this->resize(0, $height, $type, $algorithm);
    	return $this;
    }
    
    public function colorSpace($space = Adept_ImageKit_ColorSpace::COLORSPACE_GREY)
    {
        $params  = array('space' => $space);
        $this->createFilter('colorSpace', $params)->apply($this->getContainer());
        return $this;
    }
    
    public function crop($left, $top, $width, $height)
    {
        $params = array(
            'left' => $left,
            'top' => $top,
            'width' => $width,
            'height' => $height
        );
        
        $this->createFilter('crop', $params)->apply($this->getContainer());
        return $this;
    }
    
    public function cropThumbnail($width, $height)
    {
        
        $params = array(
            'width' => $width,
            'height' => $height
        );
        
        $this->createFilter('cropThumbnail', $params)->apply($this->getContainer());
        return $this;
    }
    
    public function sharpen($amount = 14.0)
    {
        $params = array(
            'amount' => $amount,
        );
        
        $this->createFilter('sharpen', $params)->apply($this->getContainer());
        return $this;
    }
    
    
    
    
}