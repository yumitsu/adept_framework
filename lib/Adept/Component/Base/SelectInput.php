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

abstract class Adept_Component_Base_SelectInput extends Adept_Component_AbstractInput 
{

    public function addItem($value, $title)
    {
        $component = new Adept_Component_Select_Item();
        $component->setValue($value);
        $component->setTitle($title);
        $this->addChild($component);
    }

    public function addItems($items)
    {
        foreach ($items as $value => $title) {
            $this->addItem($value, $title);
        }
    }
        
    /**
     * Returns Select Items iterator.
     *
     * @return unknown
     */
    public function getSelectItemsIterator()
    {
        return new Adept_Component_Select_Iterator($this);    
    }
    
    /**
     * Returns "selected" state. 
     *
     * @param string $itemValue
     * @return bool
     */
    public function isItemSelected($itemValue)
    {
        if ($this->isMultiple()) {
            $selected = $this->getSelected();
            return is_array($selected) ? in_array($itemValue, $selected) : false;
        } else {
            return $this->getSelected() == $itemValue;
        }
    }
    
    public function getSelected()
    {
        if ($this->isSubmitted()) {
            return $this->getSubmittedValue();
        } else {
            return $this->convertToView($this->getValue());
        }
    }
    
    public function isMultiple()
    {
        return false;
    }
    
}