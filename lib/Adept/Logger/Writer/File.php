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
 * @package    Adept_Logger
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Logger_Writer_File extends Adept_Logger_Writer_Abstract
{
    const WRITE_MODE  = 'w';
    const APPEND_MODE = 'a';
    
    protected $stream = null;
    
    public function __construct($streamOrUrl, $writeMode = self::APPEND_MODE)
    {
        if (is_resource($streamOrUrl)) {
            if (get_resource_type($streamOrUrl) != 'stream') {
                throw new Adept_Logger_Exception('Resource is not a stream');
            }
            
            if ($writeMode != self::APPEND_MODE && $writeMode != self::WRITE_MODE) {
                throw new Adept_Logger_Exception('Mode cannot be changed on existing streams');
            }
            $this->stream = $streamOrUrl;
        } elseif (!$this->stream = @fopen($streamOrUrl, $writeMode)) {
            $msg = '"' . $streamOrUrl . '" cannot be opened with mode "' . $writeMode . '"';
            throw new Adept_Logger_Exception($msg);
        }
    }

    public function destroy()
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }
    }
    
    /**
     * @param Adept_Logger_Record $record
     */
    protected function format($record)
    {
        //$result = "------------------------------------------------------\n";
                 
        $result = "";
        $result .= date("d-m-Y H:i", $record->getTimeStamp()) . "\t";
               
        $type = "unknown";
        switch($record->getType())
        {
            case Adept_Logger::LOG_CRITICAL : $type = "CRITICAL";break;
            case Adept_Logger::LOG_DEBUG    : $type = "DEBUG";break;
            case Adept_Logger::LOG_ERROR    : $type = "ERROR";break;
            case Adept_Logger::LOG_FINE     : $type = "FINE";break;
            case Adept_Logger::LOG_INFO     : $type = "INFO";break;
            case Adept_Logger::LOG_NOTICE   : $type = "NOTICE";break;
            case Adept_Logger::LOG_WARNING  : $type = "WARNING";break;
        }
        
        //$result .= "[" . $type . "]\t";
        //$result .= $record->getName() . "\t";
        
        $result .= $record->getMessage() . "\t"; 
                        
        if (is_array($record->getParameters()) && count($record->getParameters()) > 0) {
            $result .= serialize($record->getParameters()) . "\t";
        } else {
            $result .= "\t"; 
        }
        return $result . "\n";
    }

    protected function doWrite($record)
    {
        $line = $this->format($record);
        
        if (!@fwrite($this->stream, $line)) {
            throw new Adept_Exception_Log("Unable to write to stream");
        }        
    }

}
