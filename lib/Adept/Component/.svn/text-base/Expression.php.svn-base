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

class Adept_Component_Expression extends Adept_Component_AbstractDummy  
{
    const PART_EXPRESSION = 'expression';
    const PART_TEXT = 'text';
    
    protected $parts = array();

    public function addExpressionPart($expression)
    {
        $this->parts[] = array('type' => self::PART_EXPRESSION, 'value' => $expression);
    }
    
    public function addTextPart($text)
    {
        $last = count($this->parts) - 1;
        if ($last >= 0 && $this->parts[$last]['type'] == self::PART_TEXT) {
            $this->parts[$last]['value'] .= $text;
        } else {
            $this->parts[] = array(
                'type' => self::PART_TEXT, 
                'value' => $text);
        }
    }
    
    public function isEmpty()
    {
        return count($this->parts) == 0;
    }
    
    public function isTextOnly()
    {
        return count($this->parts) == 1 && $this->parts[0]['type'] == self::PART_TEXT;
    }
    
    public function getPart($index)
    {
        return isset($this->parts[$index]) ? $this->parts[$index] : null;
    }
    
    public function getExpression()
    {
        return $this->getValueExpression('expression');
    }
    
    public function setExpression($expression) 
    {
        if (is_string($expression)) {
            $expression = '{' . $expression . '}';
        }
        $this->setValueExpression('expression', $expression);
    }

    /**
     * @return array
     */
    protected function evalExpressionValues()
    {
        $expr = 'array(';
        $index = 0;
        foreach ($this->parts as $part) {
            if ($part['type'] == self::PART_EXPRESSION) {
                $part = $index . ' => (' . $part['value'] . ')';
                $expr .= $part . ',';
            }
            $index++;
        }
        $expr .= ')';
        $expr = Adept_Expression_Factory::getInstance()->createNativeExpression($expr);
        return $expr->getValue($this->getExpressionContext());
    }
    
    // -------------------------------------------------------------------------
    
    public function renderChildren() 
    {
        if ($this->isEmpty()) {
            return ;
        }
        if ($this->isTextOnly()) {
            $this->getResponseWriter()->writeHtml($this->parts[0]['value']);
        } else {
            $values = $this->evalExpressionValues();
            $index = 0;            
            $writer = $this->getResponseWriter();
            foreach ($this->parts as $part) {
                if ($part['type'] == self::PART_TEXT) {
                    $writer->writeHtml($part['value']);    
                } else {
                    $writer->writeText($values[$index]);
                }
                $index++;
            }
        }
    }
    
    public function getResponseWriter()
    {
        return $this->getContext()->getResponseWriter();
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
}