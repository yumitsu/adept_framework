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

class Adept_Component_Core_Switch extends Adept_Component_Base_Conditional 
{

    protected $switchValue;
    protected $useDefault;
    
    public function getSwitchValue() 
    {
        return $this->switchValue;
    }
    
    public function setSwitchValue($switchValue) 
    {
        $this->switchValue = $switchValue;
    }
    
    public function isUseDefault() 
    {
        return $this->useDefault;
    }
    
    public function setUseDefault($useDefault) 
    {
        $this->useDefault = $useDefault;
    }
    
    public function renderChildren()
    {
        $this->setSwitchValue($this->evalCondition());
        $this->setUseDefault(true);
        
        parent::renderChildren();
        
        if ($this->isUseDefault()) {
            $defaultFacet = $this->getFacet('default');
            if ($defaultFacet !== null) {
                $defaultFacet->render();
            }
        }
    }

    public function compareWithCase($caseValue)
    {
        $caseValue = (string) $caseValue;
        $switchValue = (string) $this->getSwitchValue();
        if ($caseValue == $switchValue) {
            $this->setUseDefault(false);
            return true;
        } 
        return false;
    }

}