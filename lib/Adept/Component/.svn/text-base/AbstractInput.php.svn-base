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

abstract class Adept_Component_AbstractInput extends Adept_Component_AbstractControl
{

    const CHANGE_EVENT = 'change';
    
    const BUNDLE = 'Adept/Validator/Messages';

    /**
     * The "required field" state for this component.
     * 
     * @var boolean
     */
    protected $required;

    /**
     * Validators list. Any validator is instance of Adept_Validator_Abstract class. 
     * 
     * @var Adept_List
     */
    protected $validators;

    /**
     * Single validation string. Used as MethodBinding validation.
     * 
     * @var string
     */
    protected $validator;

    /**
     * Converter method binding 
     *
     * @var string
     */
    protected $converter;

    /**
     * Converter instance.
     * 
     * @var Adept_Converter_Interface
     */
    protected $converterObject;
    
    // Events -----------------------------------------------------------------
    
    public function addChangeListener($listener)
    {
        $this->addEventListener(self::CHANGE_EVENT, $listener);
    }
    
    protected  function defineProperties()
    {
        parent::defineProperties();
        
        $this->addPropertyDescription('binding');
        $this->addPropertyDescription('converter');
        $this->addPropertyDescription('converterObject');
        
        $this->addPropertyDescription('submittedValue', array(self::CAP_CLIENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('localValue', array(self::CAP_CLIENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('localValueSet', array(self::CAP_CLIENT), false, self::TYPE_BOOL);
        $this->addPropertyDescription('valid',  array(self::CAP_CLIENT), true, self::TYPE_BOOL);
        
        $this->addPropertyDescription('required', array(self::CAP_PERSISTENT), false, self::TYPE_BOOL);
        $this->addPropertyDescription('requiredMessage', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('validatorMessage', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('converterMessage', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
    }
    
    // Properties -------------------------------------------------------------
    
    public function getSubmittedValue()
    {
        return $this->getProperty('submittedValue');
    }

    public function setSubmittedValue($submittedValue)
    {
        $this->setProperty('submittedValue', $submittedValue);
    }

    public function isSubmitted()
    {
        return $this->getSubmittedValue() !== null;    
    }
    
    public function getLocalValue()
    {
        return $this->getProperty('localValue');
    }
    
    protected function isLocalValueSet()
    {
        return $this->getProperty('localValueSet');
    } 
    
    public function getValue() 
    {
        $value = $this->getLocalValue();
        if ($value === null) {
            $binding = $this->getValueBinding('binding');
            if ($binding != null) {
                $value = $binding->getValue($this->getExpressionContext());
            } else {
                $ve = $this->getValueExpression('value');
                if ($ve != null) {
                    $value  = $ve->getValue($this->getExpressionContext());
                }
            }
        } 
        return $value;
    }
    
    public function setValue($value) 
    {
        $this->setProperty('localValue', $value);
        $this->setProperty('localValueSet', true);
    }
    
    public function resetValue()
    {
        $this->setProperty('localValue');
        $this->setProperty('localValueSet');
    }

    public function getBinding() 
    {
        return $this->getProperty('binding');
    }
    
    public function setBinding($binding)
    {
        $this->setProperty('binding', $binding);
    }

    // Required field feature -------------------------------------------------

    public function isRequired()
    {
        return $this->getProperty('required');
    }

    public function setRequired($required)
    {
        $this->setProperty('required', $required);
    }

    // Error messages ---------------------------------------------------------
    
    public function getRequiredMessage()
    {
        return $this->getProperty('requiredMessage');
    }

    public function setRequiredMessage($requiredMessage)
    {
        $this->setProperty('requiredMessage', $requiredMessage);
    }

    public function getValidatorMessage()
    {
        return $this->getProperty('validatorMessage');
    }

    public function setValidatorMessage($validatorMessage)
    {
        $this->setProperty('validatorMessage', $validatorMessage);
    }
    
    public function getConverterMessage() 
    {
        return $this->getProperty('converterMessage');
    }
    
    public function setConverterMessage($converterMessage)
    {
        $this->setProperty('converterMessage', $converterMessage);
    }

    /**
     * Returns true if $value is empty for this component.
     * Equals true if $value is empty string or spaces by default.
     * 
     * @param boolean $value
     */
    public function isEmpty($value)
    {
        // By default
        if (is_array($value)) {
            return count($value) == 0;
        } elseif (is_string($value)) {
            return trim($value) == '';
        } elseif (is_numeric($value)) {
            return $value == 0;
        } else {
            return $value == null;
        }
    }

    // Validation and convertion ----------------------------------------------

    /**
     * Returns is this component valid flad. 
     * 
     * @return boolean If nothing defined returns true.
     */
    public function isValid()
    {
        return $this->getProperty('valid');
    }

    public function setValid($valid)
    {
        $this->setProperty('valid', $valid);
        // Notify form if field is not vaild
        if (!$valid) {
            $form = $this->getForm();
            if ($form != null) {
                $form->setValid(false);
            }
        }
    }

    /**
     * Add validator object. 
     *
     * @param Adept_Validator_Abstract $validator
     * @return void
     */
    public function addValidator($validator)
    {
        if ($this->validators === null) {
            $this->validators = new Adept_List();
        }
        $this->validators->add($validator);
    }

    /**
     * Remove validator if presents. 
     * 
     * @return void
     */
    public function removeValidator($validator)
    {
        if ($this->validators !== null) {
            $index = $this->validators->indexOf($validator);
            if ($index !== false) {
                $this->validators->remove($index);
            }
        }
    }
    
    public function getValidators()
    {
        if ($this->validators === null) {
            $this->validators = new Adept_List();
        }
        return $this->validators;
    }

    /**
     * Returns validation binding, if any
     *
     * @return Adept_Expression_MethodBinding 
     */
    public function getValidator()
    {
        return $this->getMethodBinding('validator');
    }

    public function setValidator($validator)
    {
        $this->setProperty('validator', $validator);
    }

    /**
     * Add new convertion message to message context.
     *
     * @param Adept_Convertor_Exception $exception
     */
    protected function addConvertionErrorMessage($exception, $messageType = null)
    {
        if ($messageType == null) {
            $messageType = $exception->getType();
        }
                
        if ($this->getConverterMessage() != null) {
            $messageText = $this->getConverterMessage();
        } else {
            $messageText = $exception->getLocalizedMessage();
        }
        
        $group = (null !== $this->getForm()) ? $this->getForm()->getClientId() : null;
        
        $message = new Adept_Message($messageText, $messageType, $group);
        
        $this->getContext()->getMessageSet()->setMessage($this->getClientId(), $message);
    }    
    
    protected function addValidationErrorMessage($messageText, $messageType = null)
    {
        if ($messageType === null) {
            $messageType = Adept_Message::ERROR;
        }
        
        $group = (null !== $this->getForm()) ? $this->getForm()->getClientId() : null;
        $message = new Adept_Message($messageText, $messageType, $group);
        
        $this->getContext()->getMessageSet()->setMessage($this->getClientId(), $message);
    }
    
    protected function validateValue($value)
    {
     
        if ($this->isValid() && $this->isRequired() && $this->isEmpty($value)) {
            // Required error
            if (null !== $this->getRequiredMessage()) {
                // Use specified message
                $message = $this->getRequiredMessage();
            } else {
                // Use default message
                // TODO Message bundle
                $message = Adept_Bundle::get('required_field', self::BUNDLE);
            }
            
            // Fill place holder {$field} as this component title.
            
            $message = Adept_Util_String::fillPlaces($message, 
                array('field' => Adept_Component_Util::getComponentTitle($this)));
            
            $this->addValidationErrorMessage($message);
            $this->setValid(false);
        }

        if ($this->isValid() && !$this->isEmpty($value)) {
            try {
                $validator = $this->getValidator();
                if ($validator != null) {
                    $validator->invoke($this->getExpressionContext(), array($this, $value));
                }
                
                foreach ($this->getValidators() as $validator) {
                    $validator->validate($this, $value);
                }
            } catch (Adept_Validator_Exception $e) {
                // Add messsage to context

                if ($this->getValidatorMessage() != null) {
                    $message = $this->getValidatorMessage();
                } else {
                    $message = $e->getLocalizedMessage();
                }
                
                $message = Adept_Util_String::fillPlaces($message, 
                    array('field' => Adept_Component_Util::getComponentTitle($this)));
                    
                $this->addValidationErrorMessage($message);
                $this->setValid(false);
            }
        }
    }

    /**
     * Convert the submitted value into a "local value" of the
     * appropriate data type, if necessary.
     *
     * @param string $value Submitted value
     * @return mixed Converted value if possible
     * @throws Adept_Converter_Exception
     */
    public function convertToModel($value)
    {
        // Try to convert via method binding 
        $binding = $this->getMethodBinding('converter');
        
        if ($binding !== null) {
            return $binding->invoke($this->getExpressionContext(), 
                array($this, $value, Adept_Converter_Interface::TO_MODEL));
        }
        
        // Try to convert via converter object
        $converter = $this->getConverterObject();
        if ($converter != null) {
            return $converter->getAsModel($this, $value);
        }

        // Try to conver via renderer default converter
        $renderer = $this->getRenderer();
        if ($renderer != null) {
            $converter = $renderer->getConverter();
            if ($converter) {
                return $converter->getAsModel($this, $value);
            }
        }
        
        // Return as is 
        return $value;
    }

    /**
     * Convert the "local value" into a "render value" of the
     * appropriate data type, if necessary.
     *
     * @param string $value Submitted value
     * @return mixed Converted value if possible
     * @throws Adept_Converter_Exception
     */
    public function convertToView($value)
    {
       
        // Try to convert via method binding 
        $binding = $this->getMethodBinding('converter');
        if ($binding !== null) {
            return $binding->invoke($this->getExpressionContext(), 
                array($this, $value, Adept_Converter_Interface::TO_VIEW));
        }
        
        // Try to convert via converter object
        $converter = $this->getConverterObject();
        if ($converter != null) {
            return $converter->getAsView($this, $value);
        }

        // Try to conver via renderer default converter
        $renderer = $this->getRenderer();
        if ($renderer != null) {
            $converter = $renderer->getConverter();
            if ($converter) {
                return $converter->getAsView($this, $value);
            }
        }
        
        // Return as is 
        return $value;
    }

    public function getConverterObject()
    {
        return $this->getProperty('converterObject');
    }

    public function setConverterObject($converterObject)
    {
        $this->setProperty('converterObject', $converterObject);
    }

    /**
     * Validation phase. {@see Adept_Lifecycle}. 
     *
     * @return void
     */
    public function validate()
    {
        // If component value if not submmited, validation should not continue
        if (!$this->isSubmitted()) {
            return ;
        }
        $submittedValue = $this->getSubmittedValue();

        // Convert value from submitted to model
        try {
            $newValue = $this->convertToModel($submittedValue);
        } catch (Adept_Converter_Exception $e) {
            $this->addConvertionErrorMessage($e);
            $this->setValid(false);
            return;
        }
        
        

        // Validate converted value
        $this->validateValue($newValue);

        // Queue changed event
        if ($this->isValid()) {
            $previous = $this->getValue();
            $this->setValue($newValue);
            $this->setSubmittedValue(null);
            
            if (!$this->equalValues($previous, $newValue)) {
                $this->queueEvent(new Adept_Event_ValueChange($this, $newValue, $previous));
            }
        }
    }
    
    protected function equalValues($first, $second)
    {
        if ($first instanceof Adept_ClassKit_Comparable && $second instanceof Adept_ClassKit_Comparable){
            return $first->compareTo($second);
        }
        
        // Compare values as strings
        $first = (string) $first;
        $second = (string) $second;
        return $first === $second;
        
    }
    
    // Update model lifecycle phase -------------------------------------------
    
    public function updateModel()
    {
        if (!$this->isValid() || !$this->isLocalValueSet()) {
            return ;
        }
        
        $form = $this->getForm();
        if($form !== null && (!$form->isValid() || !$form->isSubmitted())){
            return ;
        }
        
        $binding = $this->getValueBinding('binding');
        if ($binding != null) {
            try {
                
                $this->getLogger()->info('Set binded value to: ' . 
                    Adept_ClassKit_Util::toString($this->getLocalValue()));
                
                $binding->setValue($this->getExpressionContext(), $this->getLocalValue());
                $this->setValue(null);
                
                $this->getLogger()->fine('Binded value setted correctly ');
                return;
            } catch (Adept_Validator_Exception $e) {
                // Validation failed in setter
                
                $this->setValid(false);
                
                
                $this->getLogger()->exception($e);
            } 
        }
    }

}
