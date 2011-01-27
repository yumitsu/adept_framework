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

class Adept_Component_Select_Items extends Adept_Component_AbstractPersistent  
{
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('values', array(), null, self::TYPE_STRING);
        $this->addPropertyDescription('titleProperty', array(), null, self::TYPE_STRING);
        $this->addPropertyDescription('valueProperty', array(), null, self::TYPE_STRING);
    }
    
    public function getValues() 
    {
        return $this->getProperty('values');
    }
    
    public function setValues($values)
    {
        $this->setProperty('values', $values);
    }

    public function getTitleProperty() 
    {
        return $this->getProperty('titleProperty');
    }
    
    public function setTitleProperty($titleProperty)
    {
        $this->setProperty('titleProperty', $titleProperty);
    }
    
    public function getValueProperty() 
    {
        return $this->getProperty('valueProperty');
    }
    
    public function setValueProperty($valueProperty)
    {
        $this->setProperty('valueProperty', $valueProperty);
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
}
