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

class Adept_Config_Php extends Adept_Config_Abstract
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
        $values = include($fileName);
        $this->parseArrayRecursive($values);
    }
    
    public function save($name)
    {        
        throw new Adept_Exception_AbstractMethod();
    }
    
    /**
     * Parse array, convert to Adept_Config
     *
     * @param Adept_Config|Adept_List $node
     * @param Adept_Config $config
     */
    public function parseArrayRecursive($node, $config = null)
    {
        if ($config === null) {
            $config = $this;
        }
        foreach ($node as $name => $child) {
            if (is_array($child)) {
                // List element found
                if (isset($child[0])) {
                    $value = new Adept_List();
                }
                else {
                    $value = new Adept_Config();
                }
                $config->set($name, $value);
                $this->parseArrayRecursive($child, $value);
            }
            else {
                // Set single value
                $config->set($name, $child);
            }
        }
    }

}