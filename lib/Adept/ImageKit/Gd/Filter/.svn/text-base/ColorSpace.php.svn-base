<?php
class Adept_ImageKit_Gd_Filter_ColorSpace extends Adept_ImageKit_Filter  implements Adept_ImageKit_ColorSpace 
{
    /**
     * @param Adept_ImageKit_Gd_Container $container
     */
    public function apply($container)
    {
        
        switch ($this->getSpace()){
            case self::COLORSPACE_GREY:
                $this->luminanceColorScale($container, array(1.0, 1.0, 1.0));
             break;
            case self::COLORSPACE_MONOCHROME:
                $this->thresholdColorScale($container,
                    array(
                        127 => array( 0, 0, 0 ),
                        255 => array( 255, 255, 255 ),
                    ));
             break;
            case self::COLORSPACE_SEPIA:
                $this->luminanceColorScale($container, array( 1.0, 0.89, 0.74 ));
             break;
            default:
                throw new Adept_Exception_IllegalState('Unsupported color space');
        }
    }
    
    /**
     * @param Adept_ImageKit_Gd_Container $container
     * @param array $scale
     */
    protected function luminanceColorScale($container, $scale)
    {
        $container->toTrueColor();
        
        for ($x = 0; $x < $container->getWidth(); $x++){
            for ($y = 0; $y < $container->getHeight(); $y++){
                $luminance = $this->getLuminanceAt($container, $x, $y );
                $newRgbValues = array(
                    'r' => $luminance * $scale[0],
                    'g' => $luminance * $scale[1],
                    'b' => $luminance * $scale[2],
                );
                $color = $container->getColor($newRgbValues['r'], $newRgbValues['g'], $newRgbValues['b']);
                imagesetpixel($container->getImage(), $x, $y, $color);
            }
        }
    }
    
    /**
     * @param Adept_ImageKit_Gd_Container $container
     * @param array $scale
     */
    protected function thresholdColorScale($container, $thresholds)
    {
       $container->toTrueColor();        
        foreach ($thresholds as $threshold => $colors ){
            $thresholds[$threshold] = array_merge(
                $colors,
                array('color' => $container->getColor($colors[0], $colors[1], $colors[2]))
            );
        }
        // Default
        if (!isset($thresholds[255])){
            $thresholds[255] = end($thresholds);
            reset($thresholds);
        }
        
        $colorCache = array();
        
        for ($x = 0; $x < $container->getWidth(); $x++){
            for ($y = 0; $y < $container->getHeight(); $y++ ){
                $luminance = $this->getLuminanceAt($container, $x, $y);
                $color = end($thresholds);
                foreach ( $thresholds as $threshold => $colorValues ){
                    if ( $luminance <= $threshold ){
                        $color = $colorValues;
                        break;
                    }
                }
                imagesetpixel($container->getImage(), $x, $y, $color['color']);
            }
        }
    }

    
    
    
    /**
     * @param Adept_ImageKit_Gd_Container $container
     * @param $x;
     * @param $y;
     */
    protected function getLuminanceAt($container, $x, $y)
    {
        $currentColor = imagecolorat($container->getImage(), $x, $y);
        $rgbValues = array(
            'r' => ($currentColor >> 16) & 0xff,
            'g' => ($currentColor >> 8) & 0xff,
            'b' => $currentColor & 0xff,
        );
        return $rgbValues['r'] * 0.299 + $rgbValues['g'] * 0.587 + $rgbValues['b'] * 0.114;
    	
    }
    
    // Properties---------------------------------------------------------------
    
    public function getSpace() 
    {
      return $this->get('space', self::COLORSPACE_GREY);
    }
    
    public function setSpace($space) 
    {
      $this->set('space', $space);
    }
    
    
}

