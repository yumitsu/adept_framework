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
 * @package    Adept_Expression
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Expression_ValueBinding implements Adept_Expression_Evaluable 
{

    protected $objectId;
    protected $objectIndex = null;
    protected $property = null;
    protected $propertyIndex = null;
    
    protected function findObject($context)
    {
        $resolver = Adept_Expression_Factory::getInstance()->getObjectResolver();
        return $resolver->getValue($context, $this->objectId, $this->objectIndex);
    }

    public function getValue($context)
    {
        $object = $this->findObject($context);

        if ($this->property === null) {
            return $object;
        }
        
        $resolver = Adept_Expression_Factory::getInstance()->getPropertyResolver();
        return $resolver->getValue($object, $this->property, $this->propertyIndex);
    }

    protected function setContextProperty($context, $value)
    {
        if ($this->objectIndex) {
            $array = $context->get($this->objectId);
            $array[$this->objectIndex] = $value;
            $context->set($this->objectId, $array);
        } else {
            $context->set($this->objectId, $value);
        }
    }

    public function setValue($context, $value)
    {
        $object = $this->findObject($context);
        if ($this->property === null) {
            $this->setContextProperty($context, $value);
            return ;
        }
        $resolver = Adept_Expression_Factory::getInstance()->getPropertyResolver();
        $resolver->setValue($object, $this->property, $value, $this->propertyIndex);
    }
    
    public function isReadOnly($context)
    {
        if ($this->property === null) {
            return false;
        }
        $resolver = Adept_Expression_Factory::getInstance()->getPropertyResolver();
        return $resolver->isReadOnly($this->findObject($context), $this->property);
    }
     
    public function getObjectId()
    {
        return $this->objectId;
    }

    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }

    public function getObjectIndex()
    {
        return $this->objectIndex;
    }

    public function setObjectIndex($objectIndex)
    {
        $this->objectIndex = $objectIndex;
    }

    public function getProperty()
    {
        return $this->property;
    }

    public function setProperty($property)
    {
        $this->property = $property;
    }

    public function getPropertyIndex()
    {
        return $this->propertyIndex;
    }

    public function setPropertyIndex($propertyIndex)
    {
        $this->propertyIndex = $propertyIndex;
    }

}