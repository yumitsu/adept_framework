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

class Adept_Template_Tag extends Adept_Template_Node 
{

    /**
     * @var Adept_Template_TagInfo
     */
    protected $tagInfo;
        
    /**
     * @var Adept_CanonicalMap
     */
    protected $attributes = null;
    
    public function __construct($name = null)
    {
        parent::__construct();
        $this->setName($name);
        $this->attributes = new Adept_CanonicalMap();
    }
    
    public function hasAttribute($name)
    {
        return $this->attributes->has($name);
    }
    
    /**
     * @param string $name
     * 
     * @return Adept_Template_TagAttribute
     */
    public function getAttribute($name)
    {
        return $this->attributes->get($name);
    }
    
    public function getAttributeValue($name, $default = null) 
    {
        if ($this->hasAttribute($name)) {
            return $this->getAttribute($name)->getValue();
        } else {
            return $default;
        }
    }
    
    public function getBoolAttributeValue($name, $default = false) 
    {
        if (!$this->hasAttribute($name)) {
            return $default;
        }
        $value = $this->getAttributeValue($name);
        return !in_array(strtolower($value), array('false', '0', '', 'null', 'no', 'f'));
    }
    
    /**
     * @return Adept_CanonicalMap
     */
    public function getAttributes() 
    {
        return $this->attributes;
    }
    
    public function setAttribute($name, $value)
    {
        $this->attributes->set($name, $value);
    } 
    
    public function addAttributes($attributes) 
    {
        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value); 
        }
    }
    
    /**
     * @return Adept_Template_TagInfo
     */
    public function getTagInfo() 
    {
        return $this->tagInfo;
    }
    
    public function setTagInfo($tagInfo) 
    {
        $this->tagInfo = $tagInfo;
    }
    
}
