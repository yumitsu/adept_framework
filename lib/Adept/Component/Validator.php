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

class Adept_Component_Validator extends Adept_Component_AbstractValidator 
{
    
    /**
     * @var Adept_Validator_Abstract
     */
    protected $validator;
    
    protected $parameters = null;
    
    public function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('class', array());
    }
    
    /**
     * @param string $class
     * @return Adept_Validator_Abstract
     */
    protected function createValidator($class)
    {
        $validator = new $class();
        if (!$validator instanceof Adept_Validator_Abstract) {
            throw new Adept_Exception('Validator should be an instance of Adept_Validator_Abstract');
        }
        return $validator;
    }
    
    /**
     * @return Adept_Validator_Abstract
     */
    public function getValidator()
    {
        if ($this->validator == null) {
            $class = $this->getClass();
            if (!class_exists($class)) {
                throw new Adept_Exception("Cannot create validator '{$class}'");
            }
            $this->validator = $this->createValidator($class);
            // Setup parameters
            foreach ($this->getParameters()->keys() as $name) {
                $value = $this->getParameter($name);
                $this->validator->setParameter($name, $value);
            }
        }
        return $this->validator;
    }

    public function getClass() 
    {
        return $this->getProperty('class');
    }
    
    public function setClass($class) 
    {
        $this->setProperty('class', $class);
    }
    
    /**
     * @return Adept_Map
     */
    public function getParameters()
    {
        if ($this->parameters == null) {
            $this->parameters = new Adept_CanonicalMap();
        }
        return $this->parameters;
    }
    
    public function getParameter($name)
    {
        if ($this->getParameters()->has($name)) {
            $value = $this->getParameters()->get($name);
            if ($value instanceof Adept_Expression_Evaluable) {
                $value = $value->getValue($this->getExpressionContext());
            }
            return $value;
        }
        return null;
    }
    
    public function setParameter($name, $value)
    {
        $this->getParameters()->set($name, $value);
    }
    
    public function setParameterExpression($name, $value)
    {
        $this->getParameters()->set($name, Adept_Expression_Factory::getInstance()->createNativeExpression($value));
    }
    
}