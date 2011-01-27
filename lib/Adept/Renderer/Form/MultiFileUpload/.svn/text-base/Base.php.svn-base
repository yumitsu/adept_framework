<?php
class Adept_Renderer_Form_MultiFileUpload_Base extends Adept_Renderer_Form_FileUpload
{
    
    
    public function __construct()
    {
    	parent::__construct();
    	$this->converter = new Adept_Converter_FileList();
    	
    }
    
    /**
     * @param Adept_Component_Form_MultiFileUpload $component
     */
    public function handleRequest($component)
    {
        parent::handleRequest($component);
        
    }
    
    

    /**
     * @param Adept_Component_Form_MultiFileUpload $component
     */
    public function renderBegin($component)
    {
         
        $writer = $this->getWriter();
        $writer->writeTag('div', array('id' => $component->getClientId()));
        $writer->writeTag('div', array(
            'id' => $component->getClientId() . Adept_Component_NamingContainer::SEPARATOR . 
                1 . Adept_Component_NamingContainer::SEPARATOR . 'container',
            'class' => $component->getContainerCssClass(),
            'style' => $component->getContainerCssStyle()
        ));
        
        $attributes = array(
            'id' => $component->getClientId() . Adept_Component_NamingContainer::SEPARATOR . 1,
            'type' => 'file',
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
            'name' => $component->getClientId() . "[]",
            'size' => $component->getSize(),
            'accesskey' => $component->getAccessKey(),
            'alt' => $component->getAlt(),
            'disabled' => $component->isDisabled(),
            'tabindex' => $component->getTabIndex(),
            'readonly' => $component->isReadOnly(),
        );        
        
                
        
        $writer->writeTag('input', $attributes, true);
        
        $writer->writeTag('span', array(
        	'id' => $component->getClientId() . Adept_Component_NamingContainer::SEPARATOR . 1 
            . Adept_Component_NamingContainer::SEPARATOR . "add",
            'style' => $component->getAddLinkStyle() != null ? $component->getAddLinkStyle()
                : 'border-bottom: 1px dashed; cursor: pointer; margin:10px;',
            'class' => $component->getAddLinkClass()
        ));
        
        $writer->writeText($component->getAddLinkText());
        $writer->writeClosedTag('span');
        $writer->writeClosedTag('div');
        $writer->writeClosedTag('div');
        
        
    }

    /**
     * @param Adept_Component_Form_MultiFileUpload $component
     */
    public function renderEnd($component)
    {
       $writer = $this->getWriter();
       $writer->writeScriptBegin();
       
       $properies = array(
            'maxFilesCount' => $component->getMaxFilesCount(),
            'deleteLinkText' => $component->getDeleteLinkText(),
            'deleteLinkStyle' => $component->getDeleteLinkStyle(),
            'deleteLinkClass' => $component->getDeleteLinkClass()
       
        );
       $this->renderClientController($component->getClientId(), "Adept.Controller.Form.MultiFileUpload", array(), $properies);
       $writer->writeScriptEnd();
        
    }
    
    public function getRequiredJs()
    {
        
        return array('Adept/Controller.js', 'Adept/Controller/Form/MultiFileUpload.js');
    }
    
     
}
