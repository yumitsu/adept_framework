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

class Adept_Component_Client_Logger extends Adept_Component_AbstractBase 
{
    
    public function hasRenderer()
    {
        return false;
    }
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('writer', array(), 'console');
    }
    
    private function getWriterClass($name)
    {
        switch ($name){
            case 'console':
                    return 'Adept.Logger.Writer.FireBug';
            case 'window':
                    return 'Adept.Logger.Writer.Window';
            default: 
                  throw new Adept_Exception_IllegalArgument('Unsupported writer type', array('writer' => $name));
        }
    }
    
    private function getWriterFile($class)
    {
        return str_replace('.', '/', $class) . 'js';
    }
    
    public function renderBegin()
    {
        $writer = $this->getResponseWriter();
        $writer->writeScriptBegin();
        $writer->writeHtml("Adept.Logger.addWriter(new {$this->getWriterClass($this->getWriter())});");
        $writer->writeScriptEnd();
    }
    
    public function getRequiredJs()
    {
        return array('Adept/Core.js', 'Adept/Logger.js', $this->getWriterFile($this->getWriterClass($this->getWriter())));
    }

    // Properies----------------------------------------------------------------
    
    public function getWriter() 
    {
       return $this->getProperty('writer');
    }
    
    public function setWriter($writer) 
    {
       $this->setProperty('writer', $writer);
    }
    
}