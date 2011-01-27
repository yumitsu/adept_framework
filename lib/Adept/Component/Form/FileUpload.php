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

class Adept_Component_Form_FileUpload extends Adept_Component_Base_TextInput 
{

    const UPLOAD_EVENT = 'upload';
    
    public function __construct()
    {
        parent::__construct();
        $this->addValidator(new Adept_Validator_SystemFile());
    }

    public function isSubmitted()
    {
        $value = $this->getSubmittedValue();
        return $value && isset($value['size']) && $value['size'] > 0;
    }

    public function invokeApplication()
    {
        if ($this->isValid() && $this->isSubmitted()) {
            $event = new Adept_Event_FileUpload($this, $this->getSubmittedValue());
            $this->invokeListenersChain(self::UPLOAD_EVENT, array($event));
        }
    }

    public function uploadFile($destinationFileName)
    {
        $file = $this->getSubmittedValue();
        if (isset($file['tmp_name'])) {
            Adept_Util_FileSystem::uploadFile($this->file['tmp_name'], $destinationFileName);
        } else {
            throw new Adept_Exception('Temporaty uploaded file name not defined. Cannot move it.');
        }
    }

    public function hasRenderer()
    {
        return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form_FileUpload';
    }    
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('size', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('readOnly', array(self::CAP_PERSISTENT), false);
    }

    public function getSize() 
    {
        return $this->getProperty('size');
    }
    
    public function setSize($size)
    {
        $this->setProperty('size', $size);
    }
    
    public function isReadOnly() 
    {
        return $this->getProperty('readOnly');
    }
    
    public function setReadOnly($readOnly)
    {
        $this->setProperty('readOnly', $readOnly);
    }
}