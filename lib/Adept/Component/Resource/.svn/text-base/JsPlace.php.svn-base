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
 * @package    Adept_Component
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Component_Resource_JsPlace extends Adept_Component_AbstractBase
{

    /**
     * @var Adept_List
     */
    protected $_files;

    /**
     * @var Adept_List
     */
    protected $_unpackagedFiles;

    /**
     * @var Adept_Map
     */
    protected $_packages;

    public function __construct()
    {
        parent::__construct();
        $this->_packages = new Adept_Map();
        $this->loadPackageConfig('Adept/JavaScript/Package/Adept.xml');
    }
    
    protected function defineProperties()
    {
    	parent::defineProperties();
    	$this->addPropertyDescription('packaged', array(), false);
    	$this->addPropertyDescription('pattern', array());
    }

    public function hasRenderer()
    {
        return false;
    }

    protected function getAbsoluteUrl($relativeUrl)
    {
        $pattern = $this->getPattern();
        if ($pattern === null) {
            $pattern = '*';
        }
        if (strpos($pattern, '*') === false) {
            $pattern .= '*';
        }
        return str_replace('*', $relativeUrl, $pattern);
    }

    protected function _addFile($fileName)
    {
        if (!$this->_files->contains($fileName) ) {
            $this->_files->add($fileName);
        }
    }

    protected function _addUnpackagedFile($fileName)
    {
        if (!$this->_unpackagedFiles->contains($fileName)) {
            $this->_unpackagedFiles->add($fileName);
        }
    }

    protected function _addPackageRequirements($packageName)
    {
        $config = $this->_packages->get($packageName);
        if ($config === null) {
            return;
        }
        // Require dependecies first.
        foreach ($config->getAsList('required') as $required) {
            $package = $required->get('package');
            if ($package !== null) {
                $this->_addPackage($package);
            }
        }
    }

    protected function _addPackage($packageName)
    {
        $config = $this->_packages->get($packageName);
        if ($config === null) {
            return;
        }
        $this->_addPackageRequirements($packageName);
        if ($this->isPackaged()) {
            $this->_addFile($config->get('archive'));
        } else {
            foreach ($config->getAsList('file') as $file) {
                $fileName = $file->get('name');
                if ($fileName != null) {
                    $this->_addFile($fileName);
                }
            }
        }
    }

    protected function _findFilePackage($needle)
    {
        foreach ($this->_packages as $package) {
            $files = $package->getAsList('file');
            foreach ($files as $file) {
                if ($file->get('name') == $needle) {
                    return $package->get('name');
                }
            }
        }
        return null;
    }

    protected function resolve($file)
    {
        $packageName = $this->_findFilePackage($file);
        if ($packageName != null) {
            if ($this->isPackaged()) {
                $this->_addPackage($packageName);
            } else {
                $this->_addPackageRequirements($packageName);
                $this->_addFile($file);
            }
        } else {
            $this->_addUnpackagedFile($file);
        }
    }

    public function loadPackageConfig($packageName)
    {
        $config = Adept_ConfigLoader::getInstance()->load($packageName);
        foreach ($config->getAsList('package') as $package) {
            if ($package->get('name') != null) {
                $this->_packages->set($package->get('name'), $package);
            }
        }
    }

    public function renderChildren()
    {
        $writer = $this->getResponseWriter();
        $components = $this->getRootView()->findFacetsAndChildrenByClass('Adept_Component_Resource_JsRequired');
        
        
        $this->_files = new Adept_List();
        $this->_unpackagedFiles = new Adept_List();
        foreach ($components as $component) {
            
            $collection = $component->getRequiredJs();
            
            foreach ($collection as $item) {
                $this->resolve($item);
            }
        }
        $pattern = $this->getPattern();
        $this->_files->merge($this->_unpackagedFiles);
        foreach ($this->_files as $item) {
            $writer->writeTag('script', array('type' => 'text/javascript', 'language' => 'javascript', 'src' => $this->getAbsoluteUrl($item)));
            $writer->writeClosedTagLn('script');
        }
    }

    // Properties--------------------------------------------------------------
    
    public function isPackaged()
    {
        return $this->getProperty('packaged');
    }

    public function setPackaged($packaged)
    {
        $this->setProperty('packaged', $packaged);
    }

    public function getPattern()
    {
        return $this->getProperty('pattern', null);
    }

    public function setPattern($pattern)
    {
        $this->setProperty('pattern', $pattern);
    }
}