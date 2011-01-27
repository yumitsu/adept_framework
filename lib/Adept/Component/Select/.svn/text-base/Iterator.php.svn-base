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

class Adept_Component_Select_Iterator implements Iterator
{

    /**
     * @var Adept_Component_AbstractComponent
     */
    protected $parent = null;

    /**
     * @var Iterator
     */
    protected $childrenIterator = null;

    /**
     * @var Iterator
     */
    protected $itemsIterator = null;

    protected $valid;
    protected $key;
    protected $current;
    
    protected $first = false;

    /**
     * @param Adept_Component_AbstractComponent $parent
     */
    public function __construct($parent)
    {
        $this->parent = $parent;
        $this->valid = false;
    }
    
    /**
     * @param Adept_Component_Select_Item $component
     * @param int $index
     */
    protected function fetchFromComponent($component, $index)
    {
        $item = new Adept_Model_SelectItem($component->getValue());
        $item->setTitle($component->getTitle());
        $item->setDescription($component->getDescription());
        $item->setDisabled($component->isDisabled());
        $item->setClientId($component->getClientId());
        return $item;
    }

    protected function fetchFromArray($array, $index)
    {
        $item = new Adept_Model_SelectItem(isset($array['value']) ? $array['value'] : $index);
        
        $item->setTitle(isset($array['title']) ? $array['title'] : null);
        $item->setDescription(isset($array['description']) ? $array['description'] : null);
        
        $item->setDisabled(isset($array['disabled']) ? $array['disabled'] : false);
        $item->setClientId(isset($array['clientId']) ? $array['clientId'] : null);
        return $item;
    }
    
    protected function fetchFromObject($selectItemsComponent, $object, $index)
    {
        if ($selectItemsComponent->getValueProperty() != null) {
            $value = Adept_ClassKit_Util::getPropertyValue($object, $selectItemsComponent->getValueProperty());
        } else {
            $value = $index;
        }
        if ($selectItemsComponent->getTitleProperty() != null) { 
            $title = Adept_ClassKit_Util::getPropertyValue($object, $selectItemsComponent->getTitleProperty());
        } else {
            $title = null;
        }
        return new Adept_Model_SelectItem($value, $title);
    }
    
    /**
     * @param Adept_Component_Select_Items $values
     * @return Iterator
     */
    public function fetchValues($component)
    {
        $items = new Adept_List();
        $index = $this->key;
        foreach ($component->getValues() as $key => $value) {
            if ($value instanceof Adept_Component_Select_Item) {
                $item = $this->fetchFromComponent($value, $index);
            } elseif ($value instanceof Adept_Model_SelectItem) {
                $item = $value; 
            } elseif (is_array($value)) {
                $item = $this->fetchFromArray($value, $index);
            } elseif (is_object($value)) {
                $item = $this->fetchFromObject($component, $value, $index);
            } else {
                $item = new Adept_Model_SelectItem($key, $value);
            }
            $items->add($item);
            $index++;
        }
        return $items->getIterator();
    }

    public function rewind()
    {
        $this->key = 0;
        $this->itemsIterator = null;
        $this->first = true;
        $this->valid = true;

        $this->childrenIterator = $this->parent->getChildren()->getIterator();
        $this->childrenIterator->rewind();
        
        $this->next();
    }

    public function valid()
    {
        return $this->valid;
    }

    protected function isItemOrItems($child)
    {
        return $child instanceof Adept_Component_Select_Item || $child instanceof Adept_Component_Select_Items;
    }

    public function findNextValidChild()
    {
        if ($this->childrenIterator->valid()) {
            do {
                $this->childrenIterator->next();
            } while ($this->childrenIterator->valid() && !$this->isItemOrItems($this->childrenIterator->current()));
            
            if ($this->childrenIterator->valid() && $this->isItemOrItems($this->childrenIterator->current())) {
                return $this->childrenIterator->current();
            }
        }
        return null;
    }

    public function next()
    {
        $first = $this->first;
        
        $this->first = false;
        
        // Skip not Select Item/Items components
        if ($this->itemsIterator) {
            $this->itemsIterator->next();
            if ($this->itemsIterator->valid()) {
                $this->key++;
                $this->current = $this->itemsIterator->current();
                return ;
            } else {
                $this->itemsIterator = null;
            }
        }

        if ($first) {
            if ($this->childrenIterator->valid() && $this->isItemOrItems($this->childrenIterator->current())) {
                $child = $this->childrenIterator->current();
            } else {
                $child = $this->findNextValidChild();
            }
        } else {
            $child = $this->findNextValidChild();
        }

        if ($child === null) {
            $this->valid = false;
            return ;
        }
        
        if ($child instanceof Adept_Component_Select_Item) {
            $this->current = new Adept_Model_SelectItem($child->getValue(), $child->getTitle(), '',
            $child->isDisabled(), $child->getClientId());
        } elseif ($child instanceof Adept_Component_Select_Items) {
            $this->itemsIterator = $this->fetchValues($child);
            $this->itemsIterator->rewind();
            if ($this->itemsIterator->valid()) {
                $this->current = $this->itemsIterator->current();
            } else {
                $this->itemsIterator = null;
                $this->next();
            }
        }
        
        if (!$first) {
            $this->key++;
        }
    }
    
    public function key()
    {
        return $this->key;
    }

    public function current()
    {
        return $this->current;
    }

}