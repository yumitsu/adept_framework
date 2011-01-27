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

class Adept_Expression_NativePhp implements Adept_Expression_Evaluable 
{

    protected $expression;    
    
    /**
     * Debug information.
     * 
     * @var stirng
     */
    protected $file = null;
    
    /**
     * @var int
     */
    protected $line = null;
    
    public function __construct($expression)
    {
        $this->expression = $expression;
    }

    public function _handleEvalFatalError($buf)
    {
        if (preg_match('/Fatal\s+error/', $buf)) {
            $revertedExpression = preg_replace('~\$context\[\'([^\']*)\'\]~', '\$$1', $this->expression);
            
            $message = "<b>Eval error:</b> Php fatal or parse error. Expression is " 
                 . "<b>" . $revertedExpression . "</b>";
            if ($this->file !== null) {
                $message .= " in <b>{$this->file}</b>"; 
            }
            if ($this->line !== null) {
                $message .= " on line <b>{$this->line}</b> ";
            }
            $message .= "<br/>\n";
            
            $buf = $message . $buf;
        }
        return $buf;
    }
    
    /**
     * Evaluate php expression and return result value.
     *
     * @return mixed
     * @throws Adept_Expression_EvalException If parse error happened
     */
    public function getValue($context)
    {
        $result = null;
        // Context used in eval expression

        // Debugging feature
        if (Adept_Debug::getFlag(Adept_Debug::EXPRESSION_EVAL_ERRORS)) {
            ob_start(array($this, '_handleEvalFatalError'));
        }
        
        $evalResult = eval('$result = (' . $this->expression . '); ' ); 
        
        if (Adept_Debug::getFlag(Adept_Debug::EXPRESSION_EVAL_ERRORS)) {
            ob_end_flush();
        }
        
        if ($evalResult === false) {
            throw new Adept_Expression_EvalException('Eval fault. Expression is [' . $this->expression . ']');
        }
        return $result;
    }
    
    /**
     * @param mixed $value
     * 
     * @throws Adept_Expression_Exception
     */
    public function setValue($context, $value)
    {
        throw new Adept_Expression_Exception('Cannot set Adept_Expression_NativePhp value. ', array('value' => $value));
    }
    
    public function isReadOnly($context)
    {
        return true;
    }
    
    /**
     * Define expression location  
     *
     * @param string $file
     * @param int $line
     */
    public function setLocation($file, $line)
    {
        $this->file = $file;
        $this->line = $line;
    }
        
}
