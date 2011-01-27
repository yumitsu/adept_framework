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
 * @package    Adept_JavaScript
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_JavaScript_Builder
{
    /**
     * @var Adept_Config
     */
    private $config;
    
    private $packagePath;
    
    public function __construct($packagePath, $config)
    {
        $this->config = Adept_ConfigLoader::getInstance()->load($config);
        $this->packagePath = $packagePath;
    }
    
    public function build($packageName)
    {
        $script = '';
        $files = array();
        $files = $this->getFiles($this->getPackage($packageName));
        foreach ($files as $fileName) {
            $script .= file_get_contents($this->packagePath . "/" .  $fileName);
        }
        return $script;
    }
    
    public function getArchiveFile($packageName)
    {
        $package = $this->getPackage($packageName);
        if ($package === null) {
            return null;
        }
        return $package->get('archive');
    }
    
    /**
     * @param Adept_Config $package
     */
    private function getFiles($package)
    {
        $fileList = array();
        foreach ($package->getAsList('file') as $file) {
            if ($file != null) {
                $fileList[] = $file->get('name');
            }   
        }
        return $fileList;
    }
    
    private function getPackage($packageName)
    {
        foreach ($this->config->getAsList('package') as $package) {
            if ($package->get('name') != null && $package->get('name') == $packageName) {
                return $package;
            }
        }
        return null;
    }
    
}

