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

class Adept_Expression_Parser 
{

    /**
     * @var Adept_Expression_Tokenizer
     */
    protected $tokenizer;
    
    protected $functions = array();
    
    protected $parts;

    public function __construct()
    {
        $this->tokenizer = new Adept_Expression_Parser_Tokenizer();
    }
    
    protected function transformVariable($token)
    {
        $varName = substr($token->getText(), 1);
        return "\$context['{$varName}']";
    }

    protected function parseExpression($expression)
    {
        $result = '';
        $tokens = $this->tokenizer->tokenize($expression);
        
        for ($i = 0; $i < count($tokens); $i++) {
            $token = $tokens[$i];
            
            if ($i < count($tokens) - 2) {
                if ($tokens[$i]->isString() && $tokens[$i + 1]->isNamespaceSeparator() && $tokens[$i + 2]->isString()) {
                    
                    // Check alias for namespace
                    $namespace = $tokens[$i];
                    $function = $tokens[$i + 2];
                    
                    $result .= $namespace->getText() . '::' . $function->getText();
                    // Skip;
                    $i += 2;
                    continue;
                }
            }
            
            if ($token->isVariable()) {
                $result .= $this->transformVariable($token);
            } else {
                $result .= $token->getText();
            }
        }
        return new Adept_Expression_Part_Expression($result);
    }
    
    protected function parseTextString($text)
    {
        return new Adept_Expression_Part_Constant($text);
    }

    public function parseParts($expression)
    {
        $buffer = '';
        $position = 0;
        $inExpression = false;

        $this->parts = array();
        
        while ($position < strlen($expression)) {
            $currentChar = $expression[$position];
            // Skip escaping char
            if ($currentChar == '\\') {
                $nextChar = ($position + 1 < strlen($expression)) ? $expression[$position + 1] : null;
                if ($nextChar == '{' || $nextChar == '}') {
                    $buffer .= $nextChar;
                    $position += 2;
                    continue;                
                }
            } 
            
            if ($currentChar == '{' && !$inExpression) { 
                // Add text block
                if (strlen($buffer) > 0) {
                    $this->parts[] = $this->parseTextString($buffer);
                }
                $buffer = '';
                // Go into expression
                $inExpression = true;
            } elseif ($currentChar == '}' && $inExpression) {
                // Add expression
                if (strlen($buffer) > 0) {
                    $this->parts[] = $this->parseExpression($buffer);
                }
                $buffer = '';
                $inExpression = false;
            } else {
                $buffer .= $currentChar;
            }
            $position++;
        }
        
        // Add tail text string
        if (strlen($buffer) > 0) {
            $this->parts[] = $this->parseTextString($buffer);
        }
        
        return $this->parts;
    }
    
    /**
     * Parse source $expression and returns composite expression 
     * if parts more than one.
     *
     * @param string $expression Source expression
     * @return Adept_Expression_Part_Abstract|null Return result 
     * composite or part; null otherwise.
     */
    public function parse($expression)
    {
        $parts = $this->parseParts($expression);
        if (count($parts) > 1) {
            $composite = new Adept_Expression_Part_Composite();
            foreach ($parts as $part) {
                $composite->add($part);
            }
            return $composite;
        } elseif (count($parts) == 1) {
            return $parts[0];
        } else {
            return null;
        }
    }
    
    public function registerFunctions($prefix, $aliases)
    {
    	$this->functions;
    }
    
}
