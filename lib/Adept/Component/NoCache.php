<?php

class Adept_Component_NoCache extends Adept_Component_AbstractBase 
{
    
    const CACHE_CLASS = 'Adept_Component_Cache';
    
    protected $_parentCache = null;
    
    /**
     * @return Adept_Component_Cache
     */
    public function getParentCache()
    {
        if ($this->_parentCache === null) {
            $this->_parentCache = $this->findParentByClass(self::CACHE_CLASS);
            if ($this->_parentCache == null) {
                //throw new Adept_Exception_NullPointer('Parent cache component is not found');
                $this->_parentCache = false;
            }
        }
        return $this->_parentCache; 
    }
    
    public function getPlaceMarker()
    {
        return '<!-- ' . $this->getClientId() . ' -->';
    }
    
    public function renderChildren()    
    {
        if ($this->getParentCache() && $this->getParentCache()->isCapturing()) {
            $this->getContext()->getResponse()->write($this->getPlaceMarker());
        } else {
            parent::renderChildren();
        }
    }

    public function renderContents()
    {
        $response = Adept_Context::getInstance()->getResponse();
        $response->startCapture();
        parent::renderChildren();
        return $response->endCapture()->getContent();
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
}

