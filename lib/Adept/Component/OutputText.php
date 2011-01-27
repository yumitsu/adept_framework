<?php

class Adept_Component_OutputText extends Adept_Component_AbstractBase 
{
    
    public function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('default');
        $this->addPropertyDescription('value');
        $this->addPropertyDescription('verbatim', array(), false, self::TYPE_BOOL);
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
    public function renderChildren()
    {
        if ($this->isRendered()) {
            $value = $this->getValue();
            if (!$value) {
                $value = $this->getDefault();
            }
            if ($this->isVerbatim()) {
                $this->getContext()->getResponseWriter()->writeHtml($value);
            } else {
                $this->getContext()->getResponseWriter()->writeText($value);
            }
        }
    }

    public function getDefault() 
    {
        return $this->getProperty('default');
    }
    
    public function setDefault($default) 
    {
        $this->setProperty('default', $default);
    }

    public function getValue() 
    {
        return $this->getProperty('value');
    }
    
    public function setValue($value) 
    {
        $this->setProperty('value', $value);
    }
    
    public function isVerbatim() 
    {
        return $this->getProperty('verbatim');
    }
    
    public function setVerbatim($verbatim) 
    {
        $this->setProperty('verbatim', $verbatim);
    }
    
}
