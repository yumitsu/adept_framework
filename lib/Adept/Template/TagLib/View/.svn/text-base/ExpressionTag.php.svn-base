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

class Adept_Template_TagLib_View_ExpressionTag extends Adept_Template_TagLib_View_ComponentTag 
{

    protected $expression;

    const PART_EXPRESSION = 'expression';
    const PART_TEXT = 'text';
        
    protected $parts = array();
    
    public function __construct()
    {
        parent::__construct('__expression');
    }
    
    public function prepare()
    {
        $this->componentClass = 'Adept_Component_Expression';
        if (null === $this->expression) {
            // TODO Fetch expression from children nodes 
        }
    }

    public function generateSetters($writer, $var)
    {
        foreach ($this->parts as $part) {
            if ($part['type'] == self::PART_TEXT) {
                $writer->writePhp("{$var}->addTextPart(");    
            } elseif ($part['type'] == self::PART_EXPRESSION) {
                $writer->writePhp("{$var}->addExpressionPart(");
            }
            $writer->writePhpLiteral($part['value']);
            $writer->writePhp(");\n");           
        }
    }
    
    public function addExpressionPart($expression)
    {
        $expression = Adept_Expression_Factory::getInstance()->getExpressionParser()
            ->parse('{' . $expression . '}')->generate();
        
        $this->parts[] = array('type' => self::PART_EXPRESSION, 'value' => $expression);
    }
    
    public function addTextPart($text)
    {
        $last = count($this->parts) - 1;
        if ($last >= 0 && $this->parts[$last]['type'] == self::PART_TEXT) {
            $this->parts[$last]['value'] .= $text;
        } else {
            $this->parts[] = array('type' => self::PART_TEXT, 'value' => $text);
        }
    }
    
    public function addPart($part)
    {
        $this->parts[] = $part;
    }
    
    public function getParts()
    {
        return $this->parts;
    }
    
    public function getExpression() 
    {
        return $this->expression;
    }
    
    public function setExpression($expression) 
    {
        $this->expression = $expression;
    }
    
}