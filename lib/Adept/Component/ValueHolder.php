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

interface Adept_Component_ValueHolder 
{

    /**
     * Return the local value of this {@link Adept_Component_AbstractComponent},
     * without evaluating any associated expressions.
     * 
     * @return The local value
     */
    public function getLocalValue();

    /**
     * <p>Gets the value of this {@link Adept_Component_AbstractComponent}.  First, consult
     * the local value property of this component.  If non-null return it.  
     * If null, see if we have a {@link ValueExpression} for the value property.  If
     * so, return the result of evaluating the property, else  otherwise
     * return <code>null</code>.
     * 
     * @return mixed The current value 
     */
    public function getValue();

    /**
     * Set the value of this component.
     *
     * @param mixed $value The new local value
     * @return void
     */
    public function setValue($value);

    /**
     * Return the {@link Adept_Converter_Interface} (if any)
     * that is registered for this component.
     * 
     * @return Adept_Converter_Interface
     */
    public function getConverter();

    /**
     * Set the coverter that is registered for this {@link Adept_Component_AbstractComponent}.
     *
     * @param Adept_Converter_Inteface $converter New {@link Converter} (or <code>null</code>)
     */
    public function setConverter($converter);
    
}