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
 * @package    Adept_Renderer
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Renderer_Form_FileUpload extends Adept_Renderer_AbstractInput 
{
    
    const ENCTYPE = 'multipart/form-data';
    
    
    protected $converter;
    
    public function __construct()
    {
        parent::__construct();
        $this->converter = new Adept_Converter_File();
    }
    
    /**
     * @return Adept_Converter_File;
     *
     */
    public function getConverter()
    {
        return $this->converter;
    }
    
    /**
     * @param Adept_Component_Form_FileUpload $component
     *
     */
    public function handleRequest($component)
    {
        $form = $component->getForm();
        if ($form !== null) {
            $form->setEnctype(self::ENCTYPE);
        }
        parent::handleRequest($component);
    }

    /**
     * @param Adept_Component_Form_FileUpload $component
     */
    public function renderBegin($component) 
    {        
        
        $attributes = array(
            'id' => $component->getClientId(),
            'type' => 'file',
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
            'name' => $component->getClientId(),
            'size' => $component->getSize(),
            'accesskey' => $component->getAccessKey(),
            'alt' => $component->getAlt(),
            'disabled' => $component->isDisabled(),
            'tabindex' => $component->getTabIndex(),
            'readonly' => $component->isReadOnly(),
        );        
        
        $attributes = array_merge($attributes, $component->getBrowserEvents());        
        
        $this->getWriter()->writeTag('input', $attributes, true);
    }        
    
}
