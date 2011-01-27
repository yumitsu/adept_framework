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

class Adept_Template_TagAttribute 
{
    
    /**
     * @var Adept_List
     */
    protected $fragments;
    
    public function __construct()
    {
        $this->fragments = new Adept_List();
    }
    
    public function isConstant()
    {
        if ($this->fragments->count() == 0) {
            return true; 
        } elseif ($this->fragments->count() == 1 && is_string($this->fragments->get(0))) {
            return true;
        }
        return false;
    }
    
    public function addTextFragment($text)
    {
        $text = (string) $text;
        // Append text if last fragment is text
        if (count($this->fragments) > 0 && is_string($this->fragments[count($this->fragments) - 1])) {
            $pos = count($this->fragments) - 1;
            $this->fragments[$pos] = $this->fragments[$pos] . $text;
            return ;
        }
        $this->fragments->add($text);
    }
    
    public function addExpressionFragment($expression)
    {
        if (is_string($expression)) {
            $expression = new Adept_Template_Expression($expression);
        }
        $this->fragments->add($expression);
    }
    
    public function getValue()
    {
        if (count($this->fragments) == 0) {
            return ''; 
        } elseif (count($this->fragments) == 1 && is_string($this->fragments[0])) {
            return $this->fragments[0];
        }
        return null;
    }
    
    public function getExpression()
    {
        $result = '';
        $parts = array();
        foreach ($this->fragments as $fragment) {
            if ($fragment instanceof Adept_Template_Expression) {
                $result .= '{' . $fragment->getExpression() . '}';
            } elseif (is_string($fragment)) {
                $result .= $fragment;
            }
        }
        return $result;
    }
    
    public function generate($writer)
    {
        if ($this->isConstant()) {
            $writer->writePhpLiteral($this->getValue());
        }
    }
    
    /**
     * @return Adept_List
     */
    public function getFragments()
    {
        return $this->fragments;
    }
    
}