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
 * @package    Adept_Validator
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

abstract class Adept_Validator_Abstract implements Adept_Validator_Interface 
{
    
    protected $bindings = array(); 
    protected $parameters = array();
    
    public function validate($sender, $value) 
    {
    }
    
    public function setParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }
    
    /**
     * @todo Move to Validator Component
     */
    public function getParameter($name, $default = null)
    {
        $name = strtolower($name);
        if (isset($this->parameters[$name])) {
           return $this->parameters[$name];
        }
        if (isset($this->bindings[$name])) {
            return $this->bindings[$name]->getValue(Adept_Context::getInstance()->getRootView()->getExpressionContext());
        }
        return $default;
    }
    
    public function getBoolParameter($name)
    {
        $value = $this->getParameter($name);
        if (is_bool($value)) {
            return $value;
        }
        return in_array(strtolower($value), array('true', 't', '1', 'y'));
    }
    
    public function hasParameter($name)
    {
        return isset($this->parameters[$name]) || isset($this->bindings[$name]);
    }
    
    public function setParameterBindingString($name, $bindingString)
    {
        $this->bindings[$name] = Adept_Expression_Factory::getInstance()->createExpression($bindingString);
    }
    
    public function getComponentTitle($component)
    {
        return Adept_Component_Util::getComponentTitle($component);    
    }
    
    public function getMessage($defaltMessage = null)
    {
        $message = $this->getParameter('message');
        return ($message !== null) ? $message : $this->getBundleMessage($defaltMessage);
    }
    
    public function getBundleMessage($key)
    {
        $localeAbbr = substr(Adept_Locale::getInstance()->toString(), 0, 2);
        
        return Adept_Bundle::getInstance()->get($key, 'Adept/Validator/Messages', $localeAbbr);
    }
    
        
}