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
 * @package    Adept_Template
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Template_TagLib_View_ValidatorTag extends Adept_Template_TagLib_View_ComponentTag 
{

    protected function generateLocalParameter($writer, $var, $info)
    {
        $setter = 'setParameter';
        $writer->writePhp("{$var}->{$setter}(");
        $writer->writePhpLiteral($info->getName());
        $writer->writePhp(', ');
        $writer->writePhpLiteral($this->getAttributeValue($info->getName()));
        $writer->writePhp(");\n");
    }
        
    protected function generateBindedParameter($writer, $var, $info)
    {
        $writer->writePhp("{$var}->setParameterExpression(");
        $writer->writePhpLiteral($info->getProperty());
        $writer->writePhp(', ');
        
        $expr = $this->getAttribute($info->getName());
        
        try {
            $parsedExpression = $this->getExpressionParser()->parse($expr->getExpression())->generate();
        } catch (Adept_Expression_Exception $cause) {
            $e = new Adept_Template_Exception('Cannot parse expression', array(), $this->fixLocation());
            $e->initCause($cause);
            throw $e;
        }
        
        $writer->writePhpLiteral($parsedExpression);       
        $writer->writePhp(");\n");
    }
    
    public function generateParameter($writer, $var, $info, $attribute)
    {
        if (!$attribute->isConstant()) {
            $this->generateBindedParameter($writer, $var, $info);
        } else {
            $this->generateLocalParameter($writer, $var, $info);
        }
    }    
    
    protected function generateSetters($writer, $var)
    {
        $properties = array('name', 'class');

        foreach ($this->getAttributes() as $name => $attribute) {
            if (in_array(strtolower($name), $properties)) {
                $info = $this->getTagInfo()->getAttributes()->get($name);
                $this->generateSetter($writer, $var, $info, $attribute);
            } else {                
                $info = new Adept_Template_AttributeInfo($name);
                $this->generateParameter($writer, $var, $info, $attribute);
            }
        }
    }
       
}