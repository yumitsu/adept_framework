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

class Adept_Component_Object_Property extends Adept_Component_AbstractBase 
{

    protected $name;
    protected $value;
    
    protected function doSet()
    {
        Adept_ClassKit_Util::setPropertyValue($this->getObject(), $this->getName(), $this->getValue());
    }
    
    public function getObject()
    {
        if (!$this->getParent() instanceof Adept_Component_Object_Factory) {
            throw new Adept_Component_Exception('Invalid parent. ObjectFactory required ');
        }
        return $this->getParent()->getObject();
    }
    
    public function processRestoreState()
    {
        $this->doSet();
    }
    
    public function renderBegin()
    {
        $this->doSet();
    }
    
    public function getName() 
    {
        if (!is_null($this->name)) {
            return $this->name;
        }
        return $this->getProperty('name');
    }
        
    public function setName($name) 
    {
        $this->name = $name;
    }
    
    public function getValue() 
    {
        if (!is_null($this->value)) {
            return $this->value;
        }
        return $this->getProperty('value', null);
    }
        
    public function setValue($value) 
    {
        $this->value = $value;
    }

    public function hasRenderer() 
    {
        return false;
    }

}
