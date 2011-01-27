<?php

class Adept_Template_TagLib_View_AttributeTag extends Adept_Template_Tag  
{

    /**
     * @param Adept_Template_PhpWriter $writer
     */
    public function generateBegin($writer)
    {
        $componentTag = $this->findParentByClass('Adept_Template_TagLib_View_ComponentTag');
        
        if (!$componentTag) {
            throw $this->createException('Parent component not found');
        }
        
        $ref = $componentTag->getElementRefCode();
        
        $writer->writePhp("{$ref}->setAttribute(");
        $writer->writePhpLiteral($this->getAttributeValue('name'));
        $writer->writePhp(', ');
        $writer->writePhpLiteral($this->getAttributeValue('value'));
        $writer->writePhp(");\n ");
    }
    
}


