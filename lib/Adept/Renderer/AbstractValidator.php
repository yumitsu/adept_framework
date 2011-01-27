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
 * @package    Adept_Renderer
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Renderer_AbstractValidator extends Adept_Renderer_AbstractControl implements Adept_Component_Resource_JsRequired
{
    const VALIDATE_EVENT = 'validate';
    const VALID_CLIENT_ENENT = 'valid';
    const INVALID_CLIENT_ENENT = 'invalid';

    protected $validatorJsClass = null;
    protected $constructorParams = array();

    /**
     * @todo Refactor
     */
    public function handleRequest($component)
    {
        $request = $this->getContext()->getRequest();
        $event = $request->get('event');
        $component->setValid(true);
        if (isset($event[$component->getClientId()]) && $event[$component->getClientId()] == self::VALIDATE_EVENT) {
            
            $valueParamName = $component->getClientId() . Adept_Component_NamingContainer::SEPARATOR . 'value';
            $submittedValue = $request->get($valueParamName);
            //            if (!$submittedValue) {
            //                return ;
            //            }
            //            $this->markDirty();
            try {
                $component->getValidator()->validate($component->getParent(), $submittedValue);
                Adept_Context::getInstance()->getAjaxChannel()->event($component->getParent()->getClientId(), self::VALID_CLIENT_ENENT);
            } catch (Adept_Validator_Exception $e) {
                $component->setValid(false);
                Adept_Context::getInstance()->getAjaxChannel()->event($component->getParent()->getClientId(), self::INVALID_CLIENT_ENENT);
                // Add validation error message
                $msg = new Adept_Message($e->getLocalizedMessage(), $e->getType());
                $messageSet = $component->getContext()->getMessageSet();
                $messageSet->setMessage($component->getParent()->getClientId(), $msg);
            }
        }
    }

    /**
     * @param Adept_Component_AbstractValidator $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        if (!$component->isClientSide()) {
            return;
        }
        $writer->writeScriptBegin();
        
        $properties = array('message' => $component->getMessage());
        
        

        if ($component->getEventType() !== null) {
            $this->constructorParams[] = $component->getEventType();
        }
        $var = $this->renderClientController($component->getParent()->getClientId(), $this->getValidatorJsClass(), $this->constructorParams, $properties);
        //        
//        $writer->writeHtml($var . "= new {$this->getValidatorJsClass()}('" . $component->getParent()->getClientId() . "'");
//        if ($component->getEventType() !== null) {
//            $writer->writeHtml("," . $component->getEventType() . ");");
//        } else {
//            $writer->writeHtml(");");
//        }
//        $writer->writeHtml("{$var}.setMessage(");
//        $writer->writeJsValue($component->getMessage());
//        $writer->writeHtml(");\n");
        $form = $component->getParent()->getForm();
        if ($form !== null) {
            $writer->writeHtml("Adept.Observer.addListener('{$form->getClientId()}', 'init', function(){");
            $writer->writeHtml($var . '.assignToForm(Adept.Application.getController("' . $form->getClientId() . '"));');
            $writer->writeHtml("});");
        }
        $writer->writeScriptEnd();
    }

    public function getValidatorJsClass()
    {
        if ($this->validatorJsClass === null) {
            throw new Adept_Exception_IllegalState("Validator Js class not defined");
        }
        return $this->validatorJsClass;
    }

    public function setValidatorJsClass($validatorJsClass)
    {
        $this->validatorJsClass = $validatorJsClass;
    }

    public function setConstructorParams($constructorParams)
    {
        $this->constructorParams = $constructorParams;
    }

    public function getRequiredJs()
    {
        return array('Adept/Validator.js');
        
    }
}
