<?php
class Adept_ImageKit_Gd_Filter_Crop extends Adept_ImageKit_Gd_Filter_Base 
{
    
	/**
     * @param Adept_ImageKit_Gd_Container $container
     */
    public function apply($container)
    {
        $top = $this->getTop();
        $left = $this->getLeft();
        $width = $this->getWidth();
        $height = $this->getHeight();
        
        $sourceWidth =  $container->getWidth();
        $sourceHeight = $container->getHeight();
        
        $left = ($left >= 0) ? $left : $sourceWidth  + $left;
        $top = ($top >= 0) ? $top : $sourceHeight + $top;
        
        $left = abs(min($left, $left + $width));
        $top = abs(min($top, $top + $height));
       
        $width = abs($width);
        $height = abs($height);

        if ($left + $width > $sourceWidth){
            $width = $sourceWidth - $left;
        }
        if ($top + $height > $sourceHeight)
        {
            $height = $sourceHeight - $top;
        }
        $this->doCrop($container, $left, $top, $width, $height);
    }
    
    
    
    /**
     * @param Adept_ImageKit_Gd_Container $container
     */
    protected function doCrop($container, $left, $top, $width, $height)
    {
        
        $oldResource  = $container->getImage();
        if (imageistruecolor($oldResource)){
            $newResource = imagecreatetruecolor($width, $height);
        }
        else{
            $newResource = imagecreate($width, $height);
        }
   
        // Save transparency, if image has it
        $bgColor = imagecolorallocatealpha($newResource, 255, 255, 255, 127);
        imagealphablending($newResource, true);
        imagesavealpha($newResource, true);
        imagefill($newResource, 1, 1, $bgColor);
        
        $result = imagecopyresampled(
            $newResource,           // destination resource 
            $oldResource,           // source resource
            0,                      // destination x coord
            0,                      // destination y coord
            $left,                     // source x coord
            $top,                     // source y coord
            $width,                 // destination width
            $height,                // destination height
            $width,                 // source witdh
            $height                 // source height
        );
        
        if($result ===  false){
            throw new Adept_Exception('can not crop image');
        }
        
        $container->replaceImage($newResource);	
    }
    
    
    
    public function getWidth() 
    {
       return $this->get('width');
    }
    
    public function setWidth($width) 
    {
       $this->set('width', $width);
    }
    
    public function getHeight() 
    {
       return $this->get('height');
    }
    
    public function setHeight($height) 
    {
       $this->set('height', $height);
    }
    
    public function getLeft() 
    {
       return $this->get('left');
    }
    
    public function setLeft($left) 
    {
       $this->set('left', $left);
    }
    
    public function getTop() 
    {
       return $this->get('top');
    }
    
    public function setTop($top) 
    {
       $this->set('top', $top);
    }
    
    
    
    
}
