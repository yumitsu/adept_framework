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

abstract class Adept_Component_AbstractValidator extends Adept_Component_AbstractPersistent implements Adept_Component_Resource_JsRequired
{
//    protected $validatePhase = false;
    

    public function init()
    {
        $this->getParent()->addValidator($this->getValidator());
        $form = $this->findParentByClass("Adept_Component_Form");
        if ($form && $this->isClientSide()){
             $form->setControllerNeeded(true);
        }
    }
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('clientSide', array(), true);
        $this->addPropertyDescription('eventType');
        $this->addPropertyDescription('message');
    }

    public function validate()
    {
        $this->getValidator()->validate($this->getParent(), $this->getParent()->getSubmittedValue());
    }
    
    public function processValidation()
    {
//        if ($this->validatePhase){
//            $this->validate();
//        }
        if ($this->hasChildrenOrFacets()) {
            foreach ($this->getFacetsAndChildren() as $component) {
                $component->processValidation();
            }
        }
    }   

    /**
     * @return Adept_Validator_Abstract
     */
    abstract public function getValidator();

    public function getRequiredJs()
    {
        if ($this->hasRenderer()) {
            $renderer = $this->getRenderer();
            if ($renderer instanceof Adept_Component_Resource_JsRequired) {
                return $renderer->getRequiredJs();
            }
        }
        return array();
    }
    
    public function hasRenderer()
    {
        return false;
    }
    

    public function setValid($valid)
    {
        $this->getParent()->setValid($valid);
    }

    public function isValid()
    {
        return $this->getParent()->isValid();
    }

    public function isClientSide()
    {
        return $this->getProperty("clientSide");
    }

    public function setClientSide($clientSide)
    {
        $this->setProperty("clientSide", $clientSide);
    }

    public function getEventType()
    {
        return $this->getProperty("eventType", "'blur'");
    }

    public function setEventType($eventType)
    {
        $this->setProperty("eventType", $eventType);
    }

    public function getMessage()
    {
        return $this->getProperty("message");
    }

    public function setMessage($message)
    {
        $this->setProperty("message", $message);
    }
}