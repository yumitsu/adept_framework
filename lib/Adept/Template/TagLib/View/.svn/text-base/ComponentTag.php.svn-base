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

class Adept_Template_TagLib_View_ComponentTag extends Adept_Template_Tag 
{
    
    protected $componentClass;
    
    protected $expressionParser;
    
    /**
     * @var Adept_List
     */
    protected $browserEvents;
    
    protected $facet = false;

    /**
     * @throws Adept_Template_Exception
     */
    public function checkAttributes()
    {
        $availableAttributes = $this->getTagInfo()->getAttributes()->keys();

        foreach ($this->getAttributes()->keys() as $name) {
            if (strtolower($name) == 'id') {
               continue;
            }
            if ($this->getTagInfo()->hasAttribute($name)) {
                continue;
            }
            if ($this->browserEvents->contains($name)) {
                continue;
            }
            throw $this->createException("Using wrong attribute [{$name}] in tag [{$this->getName()}] ", 
                array('Tag' => $this->getName(), 'Attribute' => $name, 
                    'Available attributes' => implode(", ", $availableAttributes)));
        }
    }
    
    public function prepare()
    {
        $this->retriveParameters();
        
        if (!$this->getTagInfo()->isDynamicAttributes()) {
            $this->checkAttributes();
        }
        
        parent::prepare();
    }
    
    protected function isBrowserEvent($name)
    {
        return $this->browserEvents->contains($name);           
    }
    
    protected function generateBindedProperty($writer, $var, $info)
    {
        $writer->writePhp("{$var}->setValueExpression(");
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
        $writer->writePhp(", true);\n");         
    }

    protected function generateLocalProperty($writer, $var, $info)
    {
        $setter = 'set' . ucfirst($info->getProperty()); 
        $writer->writePhp("{$var}->{$setter}(");
        if ($info->isBoolean()) {
            $writer->writePhpBoolean($this->getBoolAttributeValue($info->getName()));
        } else {
            $writer->writePhpLiteral($this->getAttributeValue($info->getName()));
        }
        $writer->writePhp(");\n");
    }
        
    protected function generateLocalBrowserEvent($writer, $var, $info)
    {
        $writer->writePhp("{$var}->setBrowserEvent(");
        $writer->writePhpLiteral($info->getProperty());
        $writer->writePhp(', ');
        $writer->writePhpLiteral($this->getAttributeValue($info->getName()));
        $writer->writePhp(");\n");        
    }

    public function generateSetter($writer, $var, $info, $attribute)
    {
        if (!$attribute->isConstant()) {
            $this->generateBindedProperty($writer, $var, $info);
        } elseif ($this->isBrowserEvent($info->getName())) {
            $this->generateLocalBrowserEvent($writer, $var, $info);
        } else {
            $this->generateLocalProperty($writer, $var, $info);
        }
    }
    
    protected function generateSetters($writer, $var)
    {
        foreach ($this->tagInfo->getAttributes() as $info) {
            if (!$this->hasAttribute($info->getName())) {
                continue ;
            }
            $attribute = $this->getAttribute($info->getName());
            if ($attribute) {
                $this->generateSetter($writer, $var, $info, $attribute);
            }
        }
    }
    
    public function generateAttachment($writer, $var)
    {
        $writer->writePhp($this->parent->getElementRefCode());
        $writer->writePhp("->addChild({$var});\n ");
    }

    public function generateBegin($writer)
    {
        $var = $this->getElementRefCode();
        $writer->writePhp("{$var} = new {$this->componentClass}();\n");
        $this->generateAttachment($writer, $var);
        
        if (Adept_Debug::getFlag(Adept_Debug::TEMPLATE_INCLUDE_LOCATION)) {
            // File 
            $writer->writePhp("{$var}->setAttribute('_file', ");
            $writer->writePhpLiteral($this->getLocation()->getFileName()); 
            $writer->writePhp("); \n");
            
            // Line
            $writer->writePhp("{$var}->setAttribute('_line', ");
            $writer->writePhpLiteral($this->getLocation()->getLineNumber()); 
            $writer->writePhp("); \n");
        }
        
        // Component Id property 
        if ($this->hasAttribute('id')) {
            $id = $this->getAttributeValue('id');            
        } else {
            $id = $this->getNodeId();
        }
        
        $writer->writePhp("{$var}->setId(");
        $writer->writePhpLiteral($id);
        $writer->writePhp("); \n");

        // Component properties, browser events and bindings 
        $this->generateSetters($writer, $var);
    }

    public function retriveParameters()
    {
        // Component parameter required
        $this->componentClass = $this->tagInfo->getParameter('component');
        if ($this->componentClass == null) {
            throw new Adept_Template_Exception("'component' parameter not defined", array(), $this->getLocation());
        }
        
        // Get and split browser events 
        $browserEvents = $this->tagInfo->getParameter('browserEvents', '');
        $this->browserEvents = new Adept_List();
        foreach (explode(',', $browserEvents) as $browserEvent) {
            $this->browserEvents->add(trim($browserEvent));
        }
    }

    /**
     * @return Adept_Expression_Parser
     */
    public function getExpressionParser()
    {
        if ($this->expressionParser == null) {
            $this->expressionParser = new Adept_Expression_Parser();
        }
        return $this->expressionParser;
    }
    
    public function getElementRefCode()
    {
        if (null == $this->refVar) {
            $this->refVar = '$_var' . ucfirst($this->getNodeId()); 
        }
        return $this->refVar;
    }
    
}