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
 * @package    Adept_Template
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Template_Parser  
{

    protected $source;
    protected $length;
    protected $position;
    protected $elementPos;
    protected $ignoreExpressions;
    
    protected $templateName;
    
    protected $literalMode = false;
    protected $literalEnd = '';
    
    /**
     * @var Adept_Template_Location
     */
    protected $location;
    
    /**
     * @var Adept_Template_ParsingObserver
     */
    protected $observer;

    public function __construct($observer = null)
    {
        $this->location = new Adept_Template_Location();
        $this->observer = $observer;
    }
    
    /**
     * @return Adept_Template_Expression_Factory
     */
    protected function getExpressionFactory()
    {
        return Adept_Template_Expression_Factory::getInstance();
    }

    public function parse($source)
    {
        $this->source = $source;
        $this->length = strlen($source);
        $this->position = 0;
        
        $this->ignoreExpressions = false;
        
        do {
            $start = $this->position;
           
            if ($this->reachedEndOfFile()) {
                return; 
            }
            
            if ($this->isLiteralMode()) {
                $endPos = stripos($this->source, '</' . $this->literalEnd . '>', $start);
                if ($endPos === false) {
                    throw new Adept_Template_Exception('Unexpected end of file in literal block', array(), 
                        clone $this->getCurrentLocation());
                }
                $literalText = substr($this->source, $this->position, $endPos - $this->position);
                $this->observer->characters($literalText); 
                $this->position += ($endPos - $this->position) + strlen($this->literalEnd) + 3;
                $this->setLiteralMode(false);
                $this->observer->endElement($this->literalEnd, '</' . $this->literalEnd . '>');
                continue;
            }
            
            while ($this->position < $this->length && ($this->ignoreExpressions || $this->source[$this->position] != '{') 
                && $this->source[$this->position] != '<') {
                $this->position++;
            }
           
            if ($this->reachedEndOfFile()) {
                if ($start < $this->length) {
                    $this->parseCharacters(substr($this->source, $start));
                }
                return ;
            }

            // any text before < considered as characters
            if ($this->position > $start)
            {
                $characters = substr($this->source, $start, $this->position - $start);
                $this->parseCharacters($characters);
            }
    
            // expression or template comment
            if ($this->source[$this->position] == '{') {
                $this->position++;
                if ($this->reachedEndOfFile()) {
                    return ;
                }
                $this->elementPos = $this->position;
                if ($this->source[$this->elementPos] == '*') {
                    // Template comment {* ... *}
                    $position = strpos($this->source, '*}', $this->elementPos);
                    if ($position === false) {
                        // Comment is not closed
                        // TODO Do something
                        return ;
                    } else {
                        $this->position = $position + 2;
                    }
                } else {
                    // Template expession like {$myVar->getMyProperty()} 
                    $position = strpos($this->source, '}', $this->elementPos);
                    if ($position === false) {
                        // Expression is not closed
                        // TODO Do something
                        return ;
                    } else {
                        $expression = substr($this->source, $this->elementPos, $position - $this->elementPos);
                        $this->parseExpression($expression);
                        $this->position = $position + 1;
                    }
                }
            } else {
            
                $this->position += 1;   // ignore '<' character
        
                if ($this->reachedEndOfFile()) {
                    return;
                }
                    
                $this->elementPos = $this->position;
                $this->position += 1;
        
                switch($this->source[$this->elementPos]) {
                    // </tag> cases
                    case '/':
                        $start = $this->position;
                        while ($this->position < $this->length && $this->source[$this->position] != '>') {
                            $this->position++;
                        }
    
                        if ($this->reachedEndOfFile()) {
                            return;
                        }
    
                        $tag = substr($this->source, $start, $this->position - $start);
        
                        $this->parseEndElement($tag, '</' . $tag . '>');
                        
                        $this->position += 1;   // ignore '>' string
                        break;
                    // <?php cases
                    case '?':
                        $start = $this->position;
                        // search instruction type
                        while ($this->position < $this->length 
                            && strpos(" \n\r\t", $this->source[$this->position]) === false) {
                            $this->position++;
                        }
        
                        if ($this->reachedEndOfFile()) {
                            return;
                        }
        
                        $instructionType = substr($this->source, $start, $this->position - $start);
        
                        $this->ignoreWhitespace();
        
                        // search instruction end and thus the instruction code
                        $start = $this->position;
                        $this->position = strpos($this->source, '?>', $start);
        
                        if ($this->position === false) {
                            $this->parseCharacters(substr($this->source, $this->elementPos - 1));
                            return;
                        }
        
                        $code = substr($this->source, $start, $this->position - $start);
                        $this->observer->processingInstruction($instructionType, $code);
        
                        $this->position += 2;   // ignore '? >' string
                        break;
                    // <!-- and <% cases
                    case '!':
                        $start = $this->position - 2;
                        if (substr($this->source, $start, 4) == "<!--") {
                            $position = strpos($this->source, '-->', $start);
                            if ($position !== false) {
                                $rawText = substr($this->source, $start, $position - $start + 3);
                                $this->parseCharacters($rawText);
                                $this->position = $position + 3;
                                break;
                            }
                        }
        
                        if (substr($this->source, $start, 3) == '<![') {
                            // CDATA section
                            $position = strpos($this->source, '[', $start + 3);
                            if ($position === false) {
                                throw new Adept_Template_Exception('Incorrect CDATA block definition', array(),
                                    $this->getCurrentLocation());
                            }
                            
                            $name = substr($this->source, $start + 3, $position - $start - 3);

                            $endPosition = strpos($this->source, ']]>', $position);
                            if ($endPosition === false) {
                                throw new Adept_Template_Exception('Unclosed CDATA block', array(),
                                    $this->getCurrentLocation());
                            }
                            $content = substr($this->source, $position + 1, $endPosition - $position - 1);
                            $cdataSource = substr($this->source, $start, $endPosition + 3 - $start);
                            $this->getObserver()->cdata($name, $content, $source);
                            
                            $this->position = $endPosition + 3;
                            break; 
                        }
                        
                        while ($this->position < $this->length && $this->source[$this->position] != '<') {
                            $this->position++;
                        }
        
                        $characters = substr($this->source, $start, $this->position - $start);
                        $this->parseCharacters($characters);
                        break;
                    case '%':
                        $start = $this->position - 2;
                        while ($this->position < $this->length && $this->source[$this->position] != '<') {
                            $this->position++;
                        }
        
                        $characters = substr($this->source, $start, $this->position - $start);
                        $this->parseCharacters($characters);
                        break;
                    // <tag or any < case (e.g. compare operator in javascript block)
                    case ' ':
                    case "\n":
                    case "\n":
                    case "\r":
                    case "\t":
                    case "=":
                        $start = $this->position - 2;
                        while ($this->position < $this->length && $this->source[$this->position] != '<') {
                            $this->position++;
                        }
                        $characters = substr($this->source, $start, $this->position - $start);
                        $this->parseCharacters($characters);
                        break;
                    default:
                        while ($this->position < $this->length 
                            && strpos("/> \n\r\t", $this->source[$this->position]) === false) {
                            $this->position++;
                        }
                        if ($this->reachedEndOfFile()) {
                            return;
                        }
        
                        $tag = substr($this->source, $this->elementPos, $this->position - $this->elementPos);
                        
                        $attributes = array();
                        $this->ignoreWhitespace();
        
                        // search end of tag
                        while ( $this->position < $this->length &&
                              $this->source[$this->position] != '/' &&
                              $this->source[$this->position] != '>')
                        {
                            $start = $this->position;
                            while ($this->position < $this->length && strpos("/>= \n\r\t", $this->source[$this->position]) === false) {
                                $this->position++;
                            }
        
                            if ($this->reachedEndOfFile()) {
                                return;
                            }
        
                            $attributeName = substr($this->source, $start, $this->position - $start);
                            $attributeValue = null;
        
                            $this->ignoreWhitespace();
        
                            if ($this->reachedEndOfFile()) {
                                return;
                            }
        
                            if ($this->source[$this->position] == '=') {
                                $attributeValue = "";
        
                                $this->position++;
                                $this->ignoreWhitespace();
        
                                if ($this->reachedEndOfFile()) {
                                    return;
                                }
        
                                $quote = $this->source[$this->position];
                                
                                if ($quote == '"' || $quote == "'") {
                                    $start = $this->position + 1;
                                    $this->position = strpos($this->source, $quote, $start);
        
                                    if ($this->position === false) {
                                        $this->parseCharacters(substr($this->source, $this->elementPos - 1));
                                        return;
                                    }
        
                                    $attributeValue = substr($this->source, $start, $this->position - $start);
                                    $this->position++;
        
                                    if ($this->reachedEndOfFile()) {
                                        return;
                                    }
        
                                    if (strpos("/> \n\r\t", $this->source[$this->position]) === false) {
                                        throw new Adept_Template_Exception('Invalid tag attribute syntax', array(), 
                                            $this->getCurrentLocation());
                                    }
        
                                } else {
                                    $start = $this->position;
                                    while ($this->position < $this->length && strpos("/> \n\r\t", 
                                        $this->source[$this->position]) === false) {
                                        $this->position++;
                                    }
                                    if ($this->reachedEndOfFile()) {
                                        return;
                                    }
                                    $attributeValue = substr($this->source, $start, $this->position - $start);
                                }
                            }
        
                            $attributes[$attributeName] = $attributeValue;
                            $this->ignoreWhitespace();
                        }
        
                        if ($this->reachedEndOfFile()) {
                            return;
                        }
        
                        if ($this->source[$this->position] == '/') {
                            $this->position += 1;
                            if ($this->reachedEndOfFile()) {
                                return;
                            }
                            if ($this->source[$this->position] != '>') {
                                throw new Adept_Template_Exception('Invalid tag syntax', array(), 
                                    clone $this->getCurrentLocation());
                            }
                            
                             
                            
                            $tagSource = '<' . substr($this->source, $this->elementPos, 
                                $this->position - $this->elementPos) . '>';
                                
                            $this->parseStartElement($tag, $attributes, true, $tagSource);
                        } else {
                            $tagSource = '<' . substr($this->source, $this->elementPos, 
                                $this->position - $this->elementPos) . '>';
                            $this->parseStartElement($tag, $attributes, false, $tagSource);
                        }
                        $this->position += 1;
                        break;      
                }
            }
        } while ($this->position < $this->length);
    }
    
    protected function parseCharacters($text)
    {
        // parse expressions in the text
        
        $text = str_replace('&ld;', '{', $text);
        $text = str_replace('&rd;', '}', $text);
        
        $this->observer->characters($text);
    }
    
    protected function parseExpression($expression)
    {        
        $this->observer->expression($expression);
    }
    
    public function removeComments($string)
    {
        return preg_replace('/(\{\*(?:[^\*]*)\*\})/is', '', $string);
    }
    
    /**
     * @param string $attribute
     * @param bool $ignoreExpression
     * @return Adept_Template_TagAttribute
     */
    protected function parseAttributeValue($attribute, $ignoreExpression = false)
    {
        $attribute = $this->removeComments($attribute);
        
        $result = new Adept_Template_TagAttribute();
        
        if ($ignoreExpression) {
           $result->addTextFragment($attribute);    
           return $result;
        }
        
        $pattern = '~\{([^\}]*)\}~';
        preg_match_all($pattern, $attribute, $matches);
        
        $expressions = $matches[1];
        $strings = preg_split($pattern, $attribute);
        
        if (count($expressions) == 0) {
            $result->addTextFragment($attribute);
            return $result;    
        }
        $parts = array();
        for ($i = 0; $i <= count($expressions); $i++) {
            if (strlen($strings[$i]) > 0) {
                $result->addTextFragment($strings[$i]);
            }
            if (isset($expressions[$i]) && strlen($expressions[$i]) > 0) {
                $result->addExpressionFragment($expressions[$i]);
            }
        }
        return $result;
    }
    
    protected function parseStartElement($tag, $attributes, $closed, $tagSource)
    {
        $this->getObserver()->startElement($tag, 
            $this->parseAttributes($attributes), $closed, $tagSource);
    }
    
    protected function parseEndElement($tag, $tagSource)
    {
        $this->getObserver()->endElement($tag, $tagSource);
    }
    
    protected function parseAttributes($attributes)
    {
        $result = array();
        foreach ($attributes as $name => $stringValue) {
            $result[$name] = $this->parseAttributeValue($stringValue);
        }
        return $result;
    }
    
    protected function ignoreWhitespace()
    {
        while ($this->position < $this->length && strpos(" \n\r\t", $this->source[$this->position]) !== false) {
            $this->position++;
        }
    }

    protected function reachedEndOfFile()
    {
        if ($this->position >= $this->length) {
            // $this->parseCharacters(substr($this->source, $this->elementPos - 1), $this->getCurrentLocation());
            return true;
        } else {
            return false;
        }
    }

    public function literalTag($literalEnd)
    {
        $this->setLiteralMode(true);
        $this->setLiteralEnd($literalEnd);
    }
    
    protected function updateLocation()
    {
        $this->location->setLineNumber(1 + substr_count(substr($this->source, 0, $this->position), "\n"));
    }
    
    public function getLocation()
    {
        $this->updateLocation();
        return $this->location;
    }
    
    public function getCurrentLocation()
    {
        $this->updateLocation();    
        return clone $this->location;
    }

    public function getObserver() 
    {
        return $this->observer;
    }
    
    public function setObserver($observer) 
    {
        $this->observer = $observer;
    }
    
    public function isLiteralMode() 
    {
        return $this->literalMode;
    }
    
    public function setLiteralMode($literalMode) 
    {
        $this->literalMode = $literalMode;
    }
    
    public function getLiteralEnd() 
    {
        return $this->literalEnd;
    }
    
    public function setLiteralEnd($literalEnd) 
    {
        $this->literalEnd = $literalEnd;
    }
    
    public function getTemplateName() 
    {
        return $this->location->templateName;
    }
    
    public function setTemplateName($templateName) 
    {
        $this->location->setFileName($templateName);
    }
    
}
