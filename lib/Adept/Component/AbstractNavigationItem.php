<?php

class Adept_Component_AbstractNavigationItem extends Adept_Component_AbstractCommand 
{

    public function getNavigationItems()
    {
    	return $this->findChildrenByClass('Adept_Component_AbstractNavigationItem', false);
    }
    
}
