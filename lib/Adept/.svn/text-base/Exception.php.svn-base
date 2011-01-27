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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

/**
 * Base exception class. Exceptions chains are supported. 
 *
 */
class Adept_Exception extends Exception 
{
    
    protected $params;
    
    /**
     * @var Exception
     */
    protected $cause;

    /**
     * Constructir
     *
     * @param Exception|string $exceptionOrMessage
     * @param int $code
     * @param array $params
     */
    public function __construct($exceptionOrMessage, $code = 0, $params = array()) 
    {
        if($exceptionOrMessage instanceof Exception) {
            $this->initCause($exceptionOrMessage);
            $message = $exceptionOrMessage->getMessage();
            $code = $exceptionOrMessage->getCode();
            parent::__construct($message, $code);
        } else {    
            parent::__construct($exceptionOrMessage, $code);
        }
        $this->params = $params;    
    }

    /**
     * Initialize cause expcetion 
     *
     * @param Exception $exception
     */
    public function initCause($exception)
    {
        $this->cause = $exception;
    }

    /**
     * Return cause exception
     *
     * @return Exception
     */
    public function getCause()
    {
        return $this->cause;
    }
    
    public function __toString() 
    {
        return $this->toString();
    }
    
    public function toString()
    {
        if (php_sapi_name() != 'cli' && !isset($_REQUEST['ajax'])) {
            require_once('Adept/Exception/Renderer/Html.php');
            $renderer = new Adept_Exception_Renderer_Html();
        } else {
            require_once('Adept/Exception/Renderer/Text.php');
            $renderer = new Adept_Exception_Renderer_Text();
        }
        return $renderer->render($this);
    }
    
    public function getParams() 
    {
        return $this->params;
    }
    
    public function setParams($params) 
    {
        $this->params = $params;
    }
    
    public function getLocalizedMessage()
    {
        return $this->getMessage();
    }
    
}
