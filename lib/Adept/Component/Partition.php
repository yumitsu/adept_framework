<?php

class Adept_Component_Partition extends Adept_Component_AbstractBase implements Adept_Component_DomContainer
{
    
    public function hasRenderer()
    {
    	return false;
    }
    
    public function getDomContainerId()
    {
        return $this->getClientId();
    }
     
}

