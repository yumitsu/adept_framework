<?php

class Adept_ImageKit_Gd_Filter_Watermark extends Adept_ImageKit_Filter 
{
    //FIXME negative x and y
    /**
     * @param Adept_ImageKit_Gd_Container $container
     */
    public function apply($container)
    {
        $watermark = $this->getWatermark();
       
         imagecopymerge($container->getImage(), $watermark->getImage(), 
            $this->getLeft(), $this->getTop(), 0, 0, $watermark->getWidth(), $watermark->getHeight()
            , 100 - $this->getOpacity());	
    }
    
    /**
     * @return Adept_ImageKit_Gd_Container
     */
    public function getWatermark() 
    {
        if (!($this->get('watermark') instanceof Adept_ImageKit_Container)){
            $conatiner = new Adept_ImageKit_Gd_Container();
            $conatiner->load($this->get('watermark'));
            $this->setWatermark($conatiner);
        }
        
      return $this->get('watermark');
    }
    
    public function setWatermark($watermark) 
    {
      $this->set('watermark', $watermark);
    }
    
    public function getTop() 
    {
      return $this->get('top');
    }
    
    public function setTop($top) 
    {
      $this->set('top', $top);
    }
    
    public function getLeft() 
    {
      return $this->get('left');
    }
    
    public function setLeft($left) 
    {
      $this->set('left', $left);
    }
    
    public function getOpacity() 
    {
      return $this->get('opacity');
    }
    
    public function setOpacity($opacity) 
    {
      $this->set('opacity', $opacity);
    }
    
}

