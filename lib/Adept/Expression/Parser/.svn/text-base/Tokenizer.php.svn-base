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

class Adept_Expression_Parser_Tokenizer 
{

    const T_SINGLE_CHAR = 'T_SINGLE_CHAR';
    
    protected $altOperators = array(
        'eq' => array(T_IS_EQUAL, '=='),
        'ne' => array(T_IS_NOT_EQUAL, '!='),
        'gt' => array(self::T_SINGLE_CHAR, '>'),
        'ge' => array(T_IS_GREATER_OR_EQUAL, '>='),
        'lt' => array(self::T_SINGLE_CHAR, '<'),
        'le' => array(T_IS_SMALLER_OR_EQUAL, '<='),
        'or' => array(T_BOOLEAN_OR, '||'),
        'and' => array(T_BOOLEAN_AND, '&&'),
        'not' => array(self::T_SINGLE_CHAR, '!'),
    );

    protected $tokens = array();

    // Constructor ------------------------------------------------------------
    
    public function __construct()
    {
    }
    
    protected function parseToken($token, $text)
    {
        // Skip <?php and ? >
        if ($token == T_OPEN_TAG || $token == T_CLOSE_TAG) {
            return ;
        }
            
        // Check for atlernative operations
        if ($token == T_STRING) {
            if (isset($this->altOperators[strtolower($text)])) {
                $tokenArray = $this->altOperators[strtolower($text)];
                $this->parseToken($tokenArray[0], $tokenArray[1]);
            }
        }
        
        // TODO Add token type check
        $this->tokens[] = new Adept_Expression_Parser_Token($token, $text);
    }
    
    public function tokenize($source)
    {

        // surround $source with <? php
        $source = '<?' . 'php ' . $source . '?>';
    
        $this->tokens = array();
   
        $tokens = token_get_all($source);
        
        foreach ($tokens as $token) {
            if (is_string($token)) {
                // Php identifier found
                $this->parseToken(self::T_SINGLE_CHAR, $token);
            } elseif (is_array($token)) {
                // Token
                list($token, $text) = $token;
                $this->parseToken($token, $text);
            }
        }
        return $this->tokens;
    }
    
}