<?php
class Adept_ImageKit_Gd_Filter_CropThumbnail extends Adept_ImageKit_Gd_Filter_Crop 
{
    /**
     * @param Adept_ImageKit_Gd_Container $container
     */
    public function apply($container)
    {
        $resizeFilter = new Adept_ImageKit_Gd_Filter_Resize(
            array('width' => $this->getWidth(), 'height' => $this->getHeight(), 'algorithm' => Adept_ImageKit_ResizeType::RESIZE_ALGORITHM_MAX)
        );
        $resizeFilter->apply($container);
         
         
        $cropOffsetX = ($container->getWidth() > $this->getWidth()) 
            ? round(($container->getWidth() - $this->getWidth()) / 2) : 0;
        $cropOffsetY = ($container->getHeight() > $this->getHeight()) 
            ? round( ($container->getHeight() - $this->getHeight()) / 2) : 0;
        $this->doCrop($container, $cropOffsetX, $cropOffsetY, $this->getWidth(), $this->getHeight());
        
    }
    
    
}
