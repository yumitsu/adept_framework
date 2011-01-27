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
 * @package    Adept_Config
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Config_Xml extends Adept_Config_Abstract 
{
        
    /**
     * Load configuration from file named $fileName.
     *
     * @param string $fileName
     * @throws Adept_Exception Throws if file not exists
     */
    public function load($fileName)
    {
        if (!file_exists($fileName)) {
            throw new Adept_Exception("File '{$fileName}' not found");
        }
        $xml = @simplexml_load_file($fileName);
        
        $this->parseXmlRecursive($xml);
    }
    
    public function save($name)
    {
        throw new Adept_Exception_AbstractMethod();
    }
    
    /**
     * Parset combined node attribute, convert to Adept_Config
     *
     * @param array $path
     * @param SimpleXMLElement $value
     * @param Adept_Config $config
     */
    protected function setByPath($path, $value, $config = null)
    {
        if ($config == null) {
            $config = $this;
        }
        // Final element found
        if (count($path) == 1) {
            $config->set($path[0], (string)$value);
            return;
        }
        $element = array_shift($path);
        // If config already exisits
        if ($config->has($element) &&
            ($config->get($element) instanceof Adept_Config ||
             $config->get($element) instanceof Adept_List)) {
            $subConfig = $config->get($element);
        } else {
            if (is_numeric($path[0])) {
                $subConfig = new Adept_List();
            } else {
                $subConfig = new Adept_Config();
            }
            $config->set($element, $subConfig);
        }
        $this->setByPath($path, $value, $subConfig);
    }
    
    protected function decodeXmlString($value) 
    {
        if (isset($this->options['encoding']) && strcasecmp($this->options['encoding'], 'utf-8') !== 0) {
            $value = iconv('UTF-8', $this->options['encoding'], $value);
        }
        return $value;
    }
    
    /**
     * Parse Simple XML Element, convert to Adept_Config
     *
     * @param SimpleXMLElement $element
     * @param Adept_Config $config
     */
    protected function parseXmlRecursive($element, $config = null)
    {
        if (!$element) {
            return;
        }
        if ($config == null) { 
            $config = $this;
        }
        foreach ($element->attributes() as $name => $value) {
            if (isset($this->options['combinedAttributes']) && $this->options['combinedAttributes']) {
                $attrPath = split($this->options['splitter'], (string)$name);
            } else {
                $attrPath = array($name);
            }
            $value = $this->decodeXmlString($value);
            $this->setByPath($attrPath, $value, $config);
        }
        
        $lists = array();
        
        foreach ($element as $name => $child) {
            
            // Flag, equals true if no attributes and no children 
            $singleValue = count($child) == 0 && count($child->attributes()) == 0;
            
            if (count($element->$name) > 1) {
                // List element found
                if (!isset($lists[$name])) {
                    $lists[$name] = new Adept_List();
                    $config->set($name, $lists[$name]);
                }
                
                if (!$singleValue) {
                    $value = new Adept_Config();
                    $this->parseXmlRecursive($child, $value);
                } else {
                    $value = $this->decodeXmlString((string) $child);
                }
                $lists[$name]->add($value);
                
            } elseif ($singleValue) {
                // Set single value
                $config->set($name, $this->decodeXmlString((string) $child));
            } else {
                // Set config 
                $subConfig = new Adept_Config();
                $this->parseXmlRecursive($child, $subConfig);
                $config->set($name, $subConfig);
            }
        }
    }
}
