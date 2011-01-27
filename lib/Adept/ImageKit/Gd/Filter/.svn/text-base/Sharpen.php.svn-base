<?php

class Adept_ImageKit_Gd_Filter_Sharpen extends Adept_ImageKit_Gd_Filter_Base 
{
    /**
     * @param Adept_ImageKit_Gd_Container $container
     */
    public function apply($container)
    {
//        $centerValue = $this->getAmount() + 16.0;
        $centerValue = 32.0 - $this->getAmount();
        
        $sharpenMatrix = array(array(-1.0, -1.0, -1.0),
                               array(-1.0, $centerValue, -1.0),
                               array(-1.0, -1.0, -1.0)
                              );
        $divisor = array_sum($sharpenMatrix[0])+array_sum($sharpenMatrix[1])+array_sum($sharpenMatrix[2]);
        $offset = 0;
        
        imageconvolution($container->getImage(), $sharpenMatrix, $divisor, $offset);
    }
    
    public function getAmount() 
    {
      return $this->get('amount');
    }
    
}


