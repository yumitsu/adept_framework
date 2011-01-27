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

/**
 * <ul>Properties:
 * <li>title
 * <li>value
 * <li>disabled
 * </ul>
 */
class Adept_Component_Select_Item extends Adept_Component_AbstractPersistent  
{
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('title', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('description', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('value', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('disabled', array(self::CAP_PERSISTENT), false, self::TYPE_BOOL);
    }
    
    public function getTitle() 
    {
        return $this->getProperty('title');
    }
    
    public function setTitle($title)
    {
        $this->setProperty('title', $title);
    }
    
    public function getDescription() 
    {
        return $this->getProperty('description');
    }
    
    public function setDescription($description)
    {
        $this->setProperty('description', $description);
    }
    
    public function getValue() 
    {
        return $this->getProperty('value');
    }
    
    public function setValue($value)
    {
        $this->setProperty('value', $value);
    }
    
    public function isDisabled() 
    {
        return $this->getProperty('disabled', false);
    }
    
    public function setDisabled($disabled)
    {
        $this->setProperty('disabled', $disabled);
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
}
