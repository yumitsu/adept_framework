<?php


class Adept_Template_TagLib_View_ConverterTag extends Adept_Template_Tag
{

    protected function generateSetters($var, $writer)
    {
        foreach ($this->getAttributes() as $name => $attribute) {
            if ($name == 'class' || $name == 'alias') {
                continue;
            }
            if ($attribute instanceof Adept_Template_Attribute_Expression) {
                $writer->writePhp("{$var}->setAttributeBindingString(");
                $writer->writePhpLiteral($name);
                $writer->writePhp(', ');
                $attribute->generateBindingString($writer);
                $writer->writePhp("); \n");
            } else {
                $writer->writePhp("{$var}->setParameter(");
                $writer->writePhpLiteral(strtolower($name));
                $writer->writePhp(", ");
                $writer->writePhpLiteral($this->getAttributeValue($name));
                $writer->writePhp("); \n");
            }
        }
    } 

    /**
     * @param Adept_Template_Writer_Php $writer
     */
    public function generateBegin($writer)
    {
        $var = $writer->generateVar();

        if ($this->hasAttribute('class')) {
            $class = $this->getAttributeValue('class');
        }

        $writer->writePhp("{$var} = new {$class}(); \n");

        $this->generateSetters($var, $writer);
        
        $componentTag = $this->getParent();
        $ref = $componentTag->getElementRefCode();
        $writer->writePhp("{$ref}->setConverterObject({$var});\n");
    }

}

