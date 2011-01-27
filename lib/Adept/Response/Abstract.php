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
 * @package    Adept_Response
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Response_Abstract 
{

    /**
     * @var bool
     */
    protected $complite = false;
    
    /**
     * Output stream.
     *
     * @var Adept_Response_Output_Interface
     */
    protected $output;
    
    protected $outputStack = array();

    public function __construct()
    {
        // Set stdout as default output stream
        $this->output = new Adept_Response_Output_Stdout();
    }
    
    /**
     * Capture output.
     *
     * @param Adept_Response_Output_Interface $output Output stream object.
     * If $output is null, Adept_Response_Output_Buffer output will be created.
     * 
     * @return Adept_Response_Output_Interface Current output stream object.
     */
    public function startCapture($output = null)
    {
        if (null === $output) {
            $output = new Adept_Response_Output_Buffer();
        }
        
        array_push($this->outputStack, $this->output);
        $this->output = $output;
        
        return $output;
    }
    
    /**
     * Ends output capture. 
     *
     * @return Adept_Response_Output_Interface Returns stream used before.
     */
    public function endCapture()
    {
        if ($this->isCaptured()) {
            $output = $this->output;
            $this->output = array_pop($this->outputStack);
            return $output;
        } else {
            throw new Adept_Exception('Output stack is free. Use startCapture before endCapture. ');
        }
    }
    
    public function flushCapture()
    {
        while ($this->isCaptured()) {
            $output = $this->endCapture();
            $this->output->write($output->flush());
        }
    }
    
    public function isCaptured()
    {
        return count($this->outputStack) > 0;
    }
    
    /**
     * Response complite flag. Turn it true if response is fully complite to notify other 
     * application components about.
     *
     * @return bool
     */
    public function isComplite() 
    {
        return $this->complite;
    }
    
    public function setComplite($complite) 
    {
        $this->complite = $complite;
    }
    
    /**
     * Output string.
     *
     * @param Adept_Verbatim|string $stringOrVerbatim String or Adept_Verbatim wrapper.
     */
    public function write($subject)
    {
        if (is_object($subject)) {
            $subject = (string) $subject;
        }
        $this->output->write($subject);
    }

    /**
     * Returns current output stream object.
     * 
     * @return Adept_Response_Output_Interface
     */
    public function getOutput()
    {
        return $this->output;
    }
    
}