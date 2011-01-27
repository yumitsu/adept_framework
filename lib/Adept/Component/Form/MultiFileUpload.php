<?php
class Adept_Component_Form_MultiFileUpload extends Adept_Component_Base_TextInput
{
    
    protected function defineProperties()
    {
    	parent::defineProperties();
    	$this->addPropertyDescription('size', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('readOnly', array(self::CAP_PERSISTENT), false);
    	$this->addPropertyDescription('maxFilesCount',array(), 5, self::TYPE_INT);
    	$this->addPropertyDescription('immediateUpload',array(self::CAP_CLIENT), 0, self::TYPE_BOOL);
    	$this->addPropertyDescription('containerCssClass', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        $this->addPropertyDescription('containerCssStyle', array(self::CAP_PERSISTENT), null, self::TYPE_STRING);
        
        $this->addPropertyDescription('addLinkClass', array(), null, self::TYPE_STRING);
        $this->addPropertyDescription('addLinkStyle', array(), null, self::TYPE_STRING);
        $this->addPropertyDescription('addLinkText', array(), 'add', self::TYPE_STRING);
        
        $this->addPropertyDescription('deleteLinkClass', array(), null, self::TYPE_STRING);
        $this->addPropertyDescription('deleteLinkStyle', array(), null, self::TYPE_STRING);
        $this->addPropertyDescription('deleteLinkText', array(), 'delete', self::TYPE_STRING);
        
    	
    	
    }
    
    protected function equalValues($first, $second)
    {
        if (!$first instanceof Adept_List || !$second instanceof Adept_List) {
            return false;
        }
        if (count($first) != count($second)) {
            return false;
        }
        foreach ($first as $firstKey => $firstItem) {
            if (!$second->contains($firstKey) || (string)$second->get($firstKey) != (string)$firstItem) {
                return false;
            }
        }
        return true;
    }
    
    public function hasRenderer()
    {
    	return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Form_MultiFileUpload_Base';
    } 
    
    // Properties---------------------------------------------------------------
    
    public function getMaxFilesCount() 
    {
        return $this->getProperty('maxFilesCount');
    }
    
    public function setMaxFilesCount($maxFilesCount) 
    {
        $this->setProperty('maxFilesCount', $maxFilesCount);
    }
    
    
    public function isImmediateUpload() 
    {
        return $this->getProperty('immediateUpload');
    }
    
    public function setImmediateUpload($immediateUpload) 
    {
        $this->setProperty('immediateUpload', $immediateUpload);
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
    
    public function getContainerCssClass() 
    {
        return $this->getProperty('containerCssClass');
    }
    
    public function setContainerCssClass($containerCssClass) 
    {
        $this->setProperty('containerCssClass', $containerCssClass);
    }
    
    public function getContainerCssStyle() 
    {
        return $this->getProperty('containerCssStyle');
    }
    
    public function setContainerCssStyle($containerCssStyle) 
    {
        $this->setProperty('containerCssStyle', $containerCssStyle);
    }
    
    public function getAddLinkClass() 
    {
        return $this->getProperty('addLinkClass');
    }
    
    public function setAddLinkClass($addLinkClass) 
    {
        $this->setProperty('addLinkClass', $addLinkClass);
    }
    
    public function getAddLinkStyle() 
    {
        return $this->getProperty('addLinkStyle');
    }
    
    public function setAddLinkStyle($addLinkStyle) 
    {
        $this->setProperty('addLinkStyle', $addLinkStyle);
    }
    
    public function getAddLinkText() 
    {
        return $this->getProperty('addLinkText');
    }
    
    public function setAddLinkText($addLinkText) 
    {
        $this->setProperty('addLinkText', $addLinkText);
    }
    
    
    public function getDeleteLinkClass() 
    {
        return $this->getProperty('deleteLinkClass');
    }
    
    public function setDeleteLinkClass($deleteLinkClass) 
    {
        $this->setProperty('deleteLinkClass', $deleteLinkClass);
    }
    
    public function getDeleteLinkStyle() 
    {
        return $this->getProperty('deleteLinkStyle');
    }
    
    public function setDeleteLinkStyle($deleteLinkStyle) 
    {
        $this->setProperty('deleteLinkStyle', $deleteLinkStyle);
    }
    
    public function getDeleteLinkText() 
    {
        return $this->getProperty('deleteLinkText');
    }
    
    public function setDeleteLinkText($deleteLinkText) 
    {
        $this->setProperty('deleteLinkText', $deleteLinkText);
    }
    
    
    
}
