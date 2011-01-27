<?php

class Adept_Component_I18n_Locale extends Adept_Component_Base_StrictConditional 
{
    public function hasRenderer()
    {
    	return false;
    }
    
    public function isProcessPhase($phaseId)
    {
        return strcasecmp($this->getLang(), $this->getLocale()->getLanguage()) === 0;
    }
    
    protected function defineProperties()
    {
    	parent::defineProperties();
    	$this->addPropertyDescription('lang');
    }    
    
    /**
     * @return Adept_Locale
     */
    public function getLocale()
    {
    	return Adept_Locale::getInstance();
    }

    public function getLang() 
    {
        return $this->getProperty('lang');
    }
    
    public function setLang($lang) 
    {
        $this->setProperty('lang', $lang);
    }
    
    
    
}

