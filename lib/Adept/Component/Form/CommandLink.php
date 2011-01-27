<?php

/**
 * Adept Framework
 *
 * LICENSE
 *
 * This source file is subject to the BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://adept-project.com/license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@adept-project.com so we can send you a copy immediately.
 *
 * @category   Adept
 * @package    Adept_Component
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Component_Form_CommandLink extends Adept_Component_Base_Button  
{
    
    public function hasRenderer()
    {
        return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form_CommandLink';
    }    
    
    public function processRestoreState()
    {
        parent::processRestoreState();
        
        if (($form = $this->getForm()) != null) {
            if ($this->isAjax()) {
                $form->setControllerNeeded(true);
            }
        }
    }
    
  
    public function setAjax($ajax)
    {
        $this->setProperty('ajax', $ajax);
        if ($ajax && ($form = $this->getForm()) != null){
            $form->setControllerNeeded(true);
        }        
    }    
    
}