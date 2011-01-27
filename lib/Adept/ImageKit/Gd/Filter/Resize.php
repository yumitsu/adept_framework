<?php
class Adept_ImageKit_Gd_Filter_Resize extends Adept_ImageKit_Filter implements Adept_ImageKit_ResizeType 
{
    
    
    /**
     * @param Adept_ImageKit_Gd_Container $container
     */
    public function apply($container)
    {
    	if ($this->getAlgorithm() != self::RESIZE_ALGORITHM_MIN && $this->getAlgorithm() != self::RESIZE_ALGORITHM_MAX) {
            throw new Adept_Exception("Unsupported resized algorithm");    		
    	}
    	
        $ratio = $this->calculateRatio($container);
        switch ($this->getResizeType()){
            case self::RESIZE_DOWN:
                $ratio = $ratio < 1 ? $ratio : 1;
                break;
            case self::RESIZE_UP:
                $ratio = $ratio > 1 ? $ratio : 1;
                break;
            case self::RESIZE_BOTH:
                break;
            default:
                throw new Adept_Exception("Unsupported resized type");
                break;
        }
        $this->doResize($container, $container->getWidth() * $ratio, $container->getHeight() * $ratio);
        
        
    }
    
    
    /**
     * @param Adept_ImageKit_Gd_Container $container
     */
    protected  function calculateRatio($container)
    {
        if ($this->getWidth() == 0 && $this->getHeight() == 0){
            throw new Adept_Exception_IllegalState('width and heigth equals 0');
        }
        if ($this->getWidth() == 0){
            return  $this->getHeight() / $container->getHeight();
        }
        if ($this->getHeight() == 0) {
        	return $this->getWidth() / $container->getWidth();
        }
        if ($this->getAlgorithm()== self::RESIZE_ALGORITHM_MAX) {
            return max($this->getHeight() / $container->getHeight(), $this->getWidth() / $container->getWidth());
        } else {
            return min($this->getHeight() / $container->getHeight(), $this->getWidth() / $container->getWidth());        	
        }
        
    }
    
    
    
    
    
    /**
     * @param Adept_ImageKit_Gd_Container $container
     * @param int $width
     * @param int $height
     */
    protected function doResize($container, $width, $height)
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
                  $newResource,
                  $oldResource,
                  0, 0, 0, 0,
                  $width,
                  $height,
                  imagesx($oldResource),
                  imagesy($oldResource)
        );
        
        if ($result === false){
            throw new Adept_Exception("Resizing failed");
        }
        $container->replaceImage($newResource);
        
    	
    }
    
    public function getWidth() 
    {
      return $this->get('width', 0);
    }
    
    public function setWidth($width) 
    {
      $this->set('width', $width);
    }
    
    
    public function getHeight() 
    {
      return $this->get('height', 0);
    }
    
    public function setHeight($height) 
    {
      
      $this->set('height', $height);
    }
    
    
//    public function isConstrainProportions() 
//    {
//      return $this->get('constrainProportions', false);
//    }
//    
//    public function setConstrainProportions($constrainProportions) 
//    {
//      $this->set('constrainProportions', $constrainProportions);
//    }
    
    public function getResizeType() 
    {
      return $this->get('resisizeType', self::RESIZE_BOTH);
    }
    
    public function setResizeType($resisizeType) 
    {
      $this->set('resisizeType', $resisizeType);
    }
    
    public function getAlgorithm() 
    {
       return $this->get('algorithm', 0);
    }
    
    public function setAlgorithm($algorithm) 
    {
       $this->set('algorithm', $algorithm);
    }    
}
