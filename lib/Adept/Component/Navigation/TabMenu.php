<?php

class Adept_Component_Navigation_TabMenu extends Adept_Component_AbstractNavigation 
{
    
    public function hasRenderer()
    {
    	return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Navigation_TabMenu';
    }
    
} 
