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
 * @package    Adept_Converter
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Converter_Abstract implements Adept_Converter_Interface
{

    /**
     * @var Adept_CanonicalMap
     */
    protected $parameters = null;

    /**
     * @var Adept_CanonicalMap
     */
    protected $bindings = null;

    public function __construct()
    {
    }

    public function getAsModel($sender, $value)
    {
        throw new Adept_Exception_AbstractMethod();
    }

    public function getAsView($sender, $value)
    {
        throw new Adept_Exception_AbstractMethod();
    }
    
    // Parameters -------------------------------------------------------------
    
    public function setParameter($name, $value)
    {
        if ($this->parameters === null) {
            $this->parameters = new Adept_CanonicalMap();
        }
        $this->parameters->set($name, $value);
    }
    
    public function getParameter($name, $default = null)
    {
        if ($this->parameters instanceof Adept_Map && $this->parameters->has($name)) {
            return $this->parameters->get($name);
        }
        if ($this->bindings instanceof Adept_Map && $this->bindings->has($name)) {
            return $this->bindings->get($name)->getValue();
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
        return ($this->parameters instanceof Adept_Map && $this->parameters->has($name))
            || ($this->bindings instanceof Adept_Map && $this->bindings->has($name));
    }

    public function setParameterBindingString($name, $bindingString)
    {
        if ($this->bindings == null) {
            $this->bindings = new Adept_CanonicalMap();
        }
        $this->bindings->set($name, Adept_Expression_Factory::createExpression($bindingString));
    }

    public function getComponentTitle($component)
    {
        return Adept_Component_Util::getComponentTitle($component);
    }

}
