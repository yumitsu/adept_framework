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

class Adept_Config_Ini extends Adept_Config_Abstract
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
        $lines = @file($fileName);
        $this->parse($lines);
    }
    
    public function save($name)
    {
        throw new Adept_Exception_AbstractMethod();
    }
    
    /**
     * Parse ini config
     *
     * @param array $lines
     * @throws Adept_Exception_IllegalArgument if incorrect argument found
     */
    protected function parse($lines)
    {
        $currentNamespace = $this;
        
        foreach ($lines as $line) {
            if (trim($line) == '') {
                continue;
            }
            
            // removing comments after #, not after # inside ""
            $line = preg_replace('/([^"#]+|"(.*?)")|(#[^#]*)/', "\\1", $line);

            // new group
            if (preg_match("#^\[(.+)\]\s*$#", $line, $newSectionNameArray)) {
                $currentSection = trim($newSectionNameArray[1]);
                $path = split($this->options['splitter'], $currentSection);
                $config = $this->getConfigByPath($path);
                $element = array_pop($path);
                $currentNamespace = new Adept_Config();
                $config->set($element, $currentNamespace);
                continue;
            }
            $expression = array();
            // check for value
            if (preg_match('#^([\w\-\[\]\.]+)(\s*)=(.*)$#', $line, $expression)) {
                $path = split($this->options['splitter'], $expression[1]);
                $canonicalPath = array();
                foreach ($path as $element) {
                    $regValues = array();
                    if (preg_match('#^([\w\-]+)(\[([\w\-]*)\]){0,1}$#', trim($element), $regValues)) {
                        $canonicalPath[] = $regValues[1];
                        // If array found
                        if (isset($regValues[2])) {
                            $canonicalPath[] = $regValues[3] != '' ? $regValues[3] : null;
                        }
                    }
                    else {
                        throw new Adept_Exception_IllegalArgument('Illegal argument ' . trim($element) . ' in expression ' . $expression[1]);
                    }
                }
                $this->setByPath($canonicalPath, $expression[3], $currentNamespace);
            }
        }
    }
    
    /**
     * Parse combined attributes, convert to Adept_Config
     *
     * @param array $path
     * @param string $value
     * @param Adept_Config $config
     */
    protected function setByPath($path, $value, $config = null)
    {
        if ($config == null) {
            $config = $this;
        }
        // Final element found
        if (count($path) == 1) {
            if ($config instanceof Adept_List && $path[0] == null) {
                $config->add($value);
            } else {
                $config->set($path[0], $value);
            }
            return;
        }
        $element = array_shift($path);
        // If config already exisits
        if ((($config instanceof Adept_Config || $config instanceof Adept_List) &&
             $config->get($element) != null) &&
            (($config->get($element) instanceof Adept_Config) ||
             ($config->get($element) instanceof Adept_List))
           ) {
            $subConfig = $config->get($element);
        } else {
            if (is_numeric($path[0]) || $path[0] == null) {
                $subConfig = new Adept_List();
            } else {
                $subConfig = new Adept_Config();
            }
            if ($config instanceof Adept_List && $element == null) {
                $config->add($subConfig);
            } else {
                $config->set($element, $subConfig);
            }
        }
        $this->setByPath($path, $value, $subConfig);
    }

    /**
     * Get config (Adept_Config) by path except the last element. Create configs if not exists.
     *
     * @param array $path
     * @param Adept_Config|Adept_List $config
     * @return string|Adept_Config|Adept_List
     */
    protected function getConfigByPath($path, $config = null)
    {
        if ($config == null) {
            $config = $this;
        }
        if (count($path) == 1) {
            return $config;
        }
        $oldConfig = $config;
        $count = count($path);
        for($i=0; $i<$count-1; $i++) {
            // Try to get config
            if ($oldConfig->has($path[$i]) &&
                ($oldConfig->get($path[$i]) instanceof Adept_Config ||
                 $oldConfig->get($path[$i]) instanceof Adept_List)
               ) {
                $config = $oldConfig->get($path[$i]);
            // Create config if not exists
            } else {
                if (is_numeric($path[$i+1])) {
                    $config = new Adept_List();
                } else {
                    $config = new Adept_Config();
                }
                $oldConfig->set($path[$i], $config);
            }
            $oldConfig = $config;
        }
        return $config;
    }

}
