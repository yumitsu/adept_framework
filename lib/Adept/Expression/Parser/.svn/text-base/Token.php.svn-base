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

class Adept_Expression_Parser_Token 
{

    protected $token;
    protected $text;
    
    public function __construct($token = null, $text = null)
    {
        $this->token = $token;
        $this->text = $text;
    }
    
    public function isVariable()
    {
        return $this->token == T_VARIABLE;
    }
    
    public function isNamespaceSeparator()
    {
    	return $this->token == T_DOUBLE_COLON;
    }
    
    public function isString()
    {
    	return $this->token == T_STRING;
    }
    
    public function isSingleChar()
    {
    	return $this->token == Adept_Expression_Parser_Tokenizer::T_SINGLE_CHAR;
    }
    
    // Properties -------------------------------------------------------------

    public function getToken() 
    {
        return $this->token;
    }
    
    public function setToken($token) 
    {
        $this->token = $token;
    }
    
    public function getText() 
    {
        return $this->text;
    }
    
    public function setText($text) 
    {
        $this->text = $text;
    }
    
}
