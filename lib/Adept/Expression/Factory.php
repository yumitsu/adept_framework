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

/**
 * Parses a String into a ValueExpression or MethodExpression instance for later evaluation.
 * 
 */
class Adept_Expression_Factory
{

    protected $objectResolver = null;
    protected $propertyResolver = null;
    
    protected $expressionParser = null;
    protected $bindingParser = null;

    protected static $instance = null;
    
    /**
     * @return Adept_Expression_Factory
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Parses an expression into a Adept_Expression_Evaluatable for later evaluation. 
     * Use this method for expressions that refer to values.
     * 
     * @param string $expression
     * @return Adept_Expression_Evaluable 
     */
    public function createExpression($expression)
    {
        $expressionObject = $this->getExpressionParser()->parse($expression);
        if (!is_object($expressionObject)) {
            throw new Adept_Expression_Exception('Cannot prepare expression ' . $expression);
        }
        return new Adept_Expression_NativePhp($expressionObject->generate());
    }
    
    /**
     * Create native php expression without parsing, as is. 
     * 
     * @internal Use createExpression method instead if possible. 
     *
     * @param string $expression
     * @return Adept_Expression_NativePhp
     */
    public function createNativeExpression($expression)
    {
        $expression = new Adept_Expression_NativePhp($expression);
        return $expression;
    }
    
    /**
     * Parses an expression into a Adept_Expression_ValueBinding for later evaluation. 
     * Use this method for expressions that refer to values.
     * 
     * @param string $expression
     * @return Adept_Expression_Evaluatable 
     */
    public function createValueBinding($expression)
    {
        $binding = new Adept_Expression_ValueBinding();
        $this->getBindingParser()->parseValueBinding($expression, $binding);
        return $binding;
    }
    
    /**
     * Parses an expression into a Adept_Expression_Method for later invokation. 
     * Use this method for expressions that should invoke methods. 
     *
     * @param string $expression
     * @return Adept_Expression_Invokable
     */
    public function createMethodBinding($expression)
    {
        $binding = new Adept_Expression_MethodBinding();
        $this->getBindingParser()->parseMethodBinding($expression, $binding);
        return $binding;
    }
     
    /**
     * Returns instance of {@link Adept_Expression_Resolver_Object}. 
     * 
     * @return Adept_Expression_Resolver_Object
     */
    public function getObjectResolver()
    {
        if (is_null($this->objectResolver)) {
            $this->objectResolver = new Adept_Expression_Resolver_Object();
        }
        return $this->objectResolver;
    }

    /**
     * Returns instance of {@link Adept_Expression_Resolver_Property}.      
     * 
     * @return Adept_Expression_Resolver_Property
     */
    public function getPropertyResolver()
    {
        if (is_null($this->propertyResolver)) {
            $this->propertyResolver = new Adept_Expression_Resolver_Property();
        }
        return $this->propertyResolver;
    }

    /**
     * Return isntance of expression parser.
     *
     * @return Adept_Expression_Parser
     */
    public function getExpressionParser() 
    {
        if (is_null($this->expressionParser)) {
            $this->expressionParser = new Adept_Expression_Parser();
        }
        return $this->expressionParser;
    }
    
    public function setExpressionParser($expressionParser) 
    {
        $this->expressionParser = $expressionParser;
    }
    
    /**
     * Returns instance of binding parser.
     *
     * @return Adept_Expression_BindingParser
     */
    public function getBindingParser() 
    {
        if (is_null($this->bindingParser)) {
            $this->bindingParser = new Adept_Expression_BindingParser();
        }
        return $this->bindingParser;
    }
    
    public function setBindingParser($bindingParser) 
    {
        $this->bindingParser = $bindingParser;
    }

}
