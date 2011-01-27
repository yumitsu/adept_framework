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

class Adept_Template_TagLibrary 
{
    
    /**
     * @var Adept_CanonicalMap
     */
    protected $tags;
    
    /**
     * @var Adept_CanonicalMap
     */
    protected $functions;
    
    public function __construct()
    {
        $this->tags = new Adept_CanonicalMap();
        $this->functions = new Adept_CanonicalMap();
    }
    
    protected function strToBool($str)
    {
        return in_array($str, array('true', 't', '1', 'yes'));
    }

    public function loadFromTld($path)
    {
        $config = Adept_ConfigLoader::getInstance()->load($path, array(), Adept_ConfigLoader::XML);
        
        foreach ($config->getAsList('tag') as $tag) {
            $tagInfo = new Adept_Template_TagInfo();   
            // Parse tagInfo properties
            if (!$tag->has('name')) {
                throw new Adept_Exception("Tag name not defined. TLD: ". $path);
            }
            $tagInfo->setName($tag->get('name'));
            $tagInfo->setClass($tag->get('tag_class'));
            
            if ($tag->has('body_content')) {
                $tagInfo->setBodyContent($tag->get('body_content'));
            }
            
            if ($tag->has('dynamic_attributes')) {
                $tagInfo->setDynamicAttributes($this->strToBool($tag->get('dynamic_attributes')));
            }
            
            // Parse attributes
            foreach ($tag->getAsList('attribute') as $attribute) {
                $attributeInfo = new Adept_Template_AttributeInfo($attribute->get('name'));
                if ($attribute->has('type')) {
                    $attributeInfo->setType($attribute->get('type'));
                }
                if ($attribute->has('required')) {
                    $attributeInfo->setRequired($this->strToBool($attribute->get('required')));
                }
                if ($attribute->has('property')) {
                    $attributeInfo->setProperty($attribute->get('property'));
                }
                $tagInfo->addAttribute($attributeInfo->getName(), $attributeInfo);
            }
            
            // Parse parameters            
            foreach ($tag->getAsList('parameter') as $parameter) {
                if ($parameter->has('name') && $parameter->has('value')) {
                    $tagInfo->getParameters()->set($parameter->get('name'), $parameter->get('value'));
                }
            }
            
            $this->tags->set($tagInfo->getName(), $tagInfo);
        }
        
        // TODO Parse functions
        
//        foreach ($modificatorsInfo as $alias => $options) {
//            $info = new Adept_Template_ModificatorInfo();
//            $info->setAlias($alias);   
//            if (!isset($options['class'])) {
//                throw new Adept_Exception('Class property not defined for modificator ' . $alias);
//            }
//            $info->setClass($options['class']);
//            if (isset($options['parameters'])) {
//                $info->setParameters($options['parameters']);
//            }
//            if (isset($options['minParams'])) {
//                $info->setMinParams($options['minParams']);
//            }
//            if (isset($options['maxParams'])) {
//                $info->setMaxParams($options['maxParams']);
//            }
//            $this->modificators[$alias] = $info;
//        }
//             
    }
    
    /**
     * @return Adept_CanonicalMap
     */
    public function getTags()
    {
        return $this->tags;
    }
    
    /**
     * @return Adept_CanonicalMap
     */
    public function getFuntions()
    {
        return $this->functions;
    }
    
    /**
     * @param string $tag
     * 
     * @return Adept_Template_TagInfo
     */
    public function getTagInfo($tag) 
    {
        return $this->tags->get($tag);
    }   
    
    public function setTagInfo($tag, $info) 
    {
        $this->tags->set($tag, $info);
    }
    
    /**
     * @param string $tag
     * 
     * @return Adept_Template_FunctionInfo
     */
    public function getFunctionInfo($function) 
    {
        return $this->functions->get($function);
    }   
    
    public function setFunctionInfo($function, $info) 
    {
        $this->functions->set($function, $info);
    }    
    
}