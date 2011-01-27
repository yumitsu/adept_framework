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
 * @package    Adept_Exception
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Exception_Renderer_Html extends Adept_Exception_Renderer_Abstract 
{

    static private $id = 1;

    protected function renderSource($exception)
    {
        // Read source 
        $source = $this->cropFile($exception->getFile(), $exception->getLine() - 5, 10);
        if (empty($source)) {
            return '';
        }
        // Add php tags anytime, so do not write php in html, guys! 
        $source = "<?php\n" . $source  . "\n?>";
        return '<code>' . highlight_string($source, true) . '</code>';
    }
    
    protected function varDump($var, $truncate = true)
    {
        $result = parent::varDump($var, $truncate);
        return htmlspecialchars($result);
    }
    
    protected function renderTrace($exception)
    {
        $result = '';
        
        foreach ($exception->getTrace() as $trace) {
            $args = array();
            
            if(isset($tarce['args']))
            {
                foreach ($trace['args'] as $arg)
                {
                    $args[] = $this->varDump($arg);
                }
            }
            
            $result .= "&nbsp;&nbsp;at ";
            if (isset($trace['file'])) {
                $result .= "<span title='{$trace['file']}'>";
            }
            
            $class = isset($trace['class']) ? $trace['class'] : ' ';
            $type = isset($trace['type']) ? $trace['type'] : ' ';
            $function = isset($trace['function']) ? $trace['function'] : 'undefined';
            $line = isset($trace['line']) ? $trace['line'] : 'undefined';
            
            $result .= $class . $type . $function . "(" . implode(', ', $args)  . "), line: " . $line;
            $result .= "</span><br/>";
        }        
        return $result; 
    }
    
    protected function renderCause($exception)
    {
        if ($exception instanceof Adept_Exception && $exception->getCause() !== null) {
            return $exception->getCause()->toString();
        } else {
            return '';
        }
    }
    
    protected function renderWrapBlock($title, $content, $renderIfEmpty = false)
    {
        if (!$renderIfEmpty && empty($content)) {
            return ;
        }
        
        $divId = self::generateId();
        
        $result = '<br/><a href="javascript:void(0);" onclick="javascript:'
            . 'var st=document.getElementById(\'' .  $divId . '\'); ' 
            . 'st.style.display=(st.style.display==\'none\')?\'block\':\'none\';">'
            . "{$title}</a>"
            . '<div id="' . $divId .'" style="display: none; margin-left: 2em; ">'
            . $content
            . '</div>';        
            
        return $result;
    }
    
    public function renderParams($exception)
    {
        $params = array(
            'Message' => $exception->getMessage(),
            'File' => $exception->getFile(),
            'Line' => $exception->getLine()
        );
        
        if ($exception instanceof Adept_Exception && is_array($exception->getParams())) {
            $params = array_merge($params, $exception->getParams());
        }
        
        $result = '<table border="0" cellspacing="0" cellpadding="1" style="font-family: Tahoma, Arial; font-size: 12px; line-height: 1.5em;">';
        foreach ($params as $key => $value) {
            $result .= '<tr>';
            $value = $this->varDump($value, false);
            $result .= '<td style="padding-right: 1em "><b>' . $key . '</b></td><td>' . $value . '</td>';
            $result .= '</tr>';
        }
        $result .= '</table>';
        return $result;
    }
    
    public function renderHeader($exception)
    {
        $result = '<div style="font-family: Tahoma, Arial; font-size: 12px; line-height: 1.5em; ">';
        $result .= '<div style="color: #c00; font-weight: bold; border-bottom: 1px solid #c00; ">';
        $result .= get_class($exception);
        $result .= '</div>';
        return $result;
    }
    
    public function renderFooter($exception)
    {
        return '</div>';
    }
    
    /**
     * @param Exception $exception
     * @return string
     */
    public function render($exception) 
    {
        $result = $this->renderHeader($exception);
        $result .= $this->renderParams($exception);
        $result .= $this->renderWrapBlock('Source', $this->renderSource($exception));
        $result .= $this->renderWrapBlock('Trace', $this->renderTrace($exception));
        $result .= $this->renderWrapBlock('Cause', $this->renderCause($exception));
        $result .= $this->renderFooter($exception);
        return $result;
    }
    
    static protected function generateId($prefix = 'var')
    {
        return $prefix . self::$id++ . '_' . rand(0, 999999);
    }
    
}