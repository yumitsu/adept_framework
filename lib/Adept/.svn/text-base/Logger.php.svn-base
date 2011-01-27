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

class Adept_Logger
{
    protected $name;
    
    protected static $loggers = array();
    protected static $writers = array();
    protected static $reportLevel = self::LOG_FINE;
    
    const LOG_CRITICAL    = 1;
    const LOG_ERROR       = 2;
    const LOG_WARNING     = 3;
    const LOG_NOTICE      = 4;
    const LOG_INFO        = 5;
    const LOG_DEBUG       = 6;
    const LOG_FINE        = 7;
    
    protected static $logged = array(
        self::LOG_CRITICAL,
        self::LOG_ERROR,
        self::LOG_WARNING,
        self::LOG_NOTICE,
        self::LOG_INFO,
        self::LOG_DEBUG,
        self::LOG_FINE 
    );
        
    protected function __construct($name)
    {
        $this->name = $name;
    }
    
    /**
     * @param string $key
     * @param string $group
     * @return Adept_Logger
     */
    public static function getLogger($name)
    {
        if (!isset(self::$loggers[$name])) {
            self::$loggers[$name] = new self($name);
        }
        return self::$loggers[$name];
    }
   
    public static function addWriter($writer)
    {
        self::$writers[] = $writer;
    }
    
    public function isLoggedType($type) 
    {
        return $type <= self::getReportLevel();
    }
    
    public function setLogged($types) 
    {
        $this->logged;
    }
    
    protected function getWriters()
    {
        return self::$writers;
    }
    
    public function log($message, $type = self::LOG_INFO, $parameters = array())
    {
        
        if ($this->isLoggedType($type) && count($this->getWriters()) > 0) {
            $record = new Adept_Logger_Record($this->name, $message, $type, $parameters, time());
            foreach ($this->getWriters() as $writer) {
                $writer->write($record);
            }
        }
    }
    
    public function info($message, $parameters = array())
    {
        $this->log($message, self::LOG_INFO, $parameters);
    }
    
    public function error($message, $parameters = array())
    {
        $this->log($message, self::LOG_ERROR, $parameters);
    }
    
    public function debug($message, $parameters = array())
    {
        $this->log($message, self::LOG_DEBUG, $parameters);
    }
    
    public function warn($message, $parameters = array())
    {
        $this->log($message, self::LOG_WARNING, $parameters);
    }
    
    public function fine($message, $parameters = array())
    {
        $this->log($message, self::LOG_FINE, $parameters);
    }
    
    /**
     * @param Exception $exception
     */
    public function exception($exception, $parameters = array())
    {
        if ($exception instanceof Adept_Exception) {
            if ($exception instanceof Adept_Exception && is_array($exception->getParams())) {
                $parameters = array_merge($parameters, $exception->getParams());
            }
        }
        $this->log($exception->getMessage(), self::LOG_ERROR, $parameters);
    }
    
    public static function setReportLevel($reportLevel)
    {
        self::$reportLevel = $reportLevel;
    }
    
    public function getReportLevel()
    {
        return self::$reportLevel;
    }

}