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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_RenderKit
{

    const DEFAULT_TYPE = 'default';
        
    protected $renderers = array();

    protected $aliases = array();

    /**
     * Imports renders config
     *
     * @param Zend_Config $config
     */
    public function importConfig($config)
    {
        foreach ($config as $componentClass => $renderers) {
            foreach ($renderers as $rendererType => $renderer) {
                $rendererType = strtolower($rendererType);
                if (!isset($this->aliases[$rendererType])) {
                    $this->aliases[$rendererType] = array();
                }
                $componentClass = strtolower($componentClass);
                $this->aliases[$rendererType][$componentClass] = $renderer;
            }
        }
    }
    
    /**
    * Get renderer class name
    *
    * @param string $componentClass
    * @param string $rendererType
    * @param bool $useDefaultIfNothingFound
    * 
    * @return string Returns renderer class or null if nothing found.
    */
    public function getRendererClass($componentClass, $rendererType = null, $useDefaultIfNothingFound = true)
    {
        if ($rendererType == null) {
            $rendererType = self::DEFAULT_TYPE;
        }
        
        $componentClass = strtolower($componentClass);
        $rendererType = strtolower($rendererType);
        
        $class = isset($this->aliases[$rendererType][$componentClass]) ?
            $this->aliases[$rendererType][$componentClass] : null;
                
        if ($class === null && $useDefaultIfNothingFound) {
            $class = isset($this->rendererClasses[self::DEFAULT_TYPE][$componentClass]) ?
                $this->aliases[self::DEFAULT_TYPE][$componentClass] : null;
        }
        
        return $class;
    }
    
    public function getRenderer($rendererClass)
    {
        if ($rendererClass == null) {
            throw new Adept_Exception_IllegalState('Renderer class not defined');
        }
    	if (!isset($this->renderers[$rendererClass])) {
    	    $this->renderers[$rendererClass] = Adept_ClassKit_Util::createObject($rendererClass, array());
    	}
    	
    	return $this->renderers[$rendererClass];
    }

    /**
     * @param string $componentClass
     * @param string $rendererTypeOfClass
     * @return Adept_Renderer_Abstract
     */
    public function resolveRenderer($componentClass, $rendererTypeOfClass)
    {
    	$class = $this->getRendererClass($componentClass, $rendererTypeOfClass);
    	if ($class == null) {
    	    $class = $rendererTypeOfClass;
    	}
    	if ($class == null) {
    	    throw new Adept_Exception('Renderer for ' . $componentClass . ' not defined');
    	}
    	return $this->getRenderer($class);
    }
    
    public function importKit($configPath)
    {
        $config = Adept_ConfigLoader::getInstance()->load($configPath);

        $rendererTypes = $config->getAsList('rendererType');
        foreach ($rendererTypes as $details) {
            $rendererType = strtolower($details->get('name'));
            $renderers = $details->getAsList('renderer');
            foreach ($renderers as $renderer) {
                $component = strtolower($renderer->get('component'));
                $this->aliases[$rendererType][$component] =  $renderer->get('class');
            }
        }
    }

//    /**
//     * Returns renderer instance for component with specified $rendererType.
//     *
//     * @param string $componentClass
//     * @param string $rendererType
//     * @param string $defaultRendererClass
//     * @return Adept_Renderer_AbstractRenderer
//     */
//    public function getRenderer($componentClass, $rendererType = null, $defaultRendererClass = null)
//    {
//        $componentClass = strtolower($componentClass);
//        
//        if (is_null($rendererType)) {
//            $rendererType = self::DEFAULT_TYPE;
//        }
//        $rendererType = strtolower($rendererType);
//        if (isset($this->renderers[$rendererType][$componentClass])) {
//            return $this->renderers[$rendererType][$componentClass];
//        }
//        
//        try {
//            $class = $this->getRendererClass($componentClass, $rendererType);
//        } catch (Adept_Exception $e) {
//            // Use default renderer class if nothing found.
//            if (null != $defaultRendererClass) {
//                $class = $defaultRendererClass;
//            } else {
//                // Throws 
//                throw $e;
//            }
//        }
//        
//        $this->renderers[$rendererType][$componentClass] = new $class();
//        return $this->renderers[$rendererType][$componentClass];
//    }
//    
//    public function setRendererClass($componentClass, $rendererType, $rendererClass)
//    {
//        if (!isset($this->rendererClasses[$rendererType])) {
//            $this->rendererClasses[$rendererType] = array();
//        }
//        $this->rendererClasses[$rendererType][$componentClass] = $rendererClass;
//    }
//    
//    public function setDefaultRendererClass($componentClass, $rendererClass)
//    {
//        $this->setRendererClass($componentClass, self::DEFAULT_TYPE, $rendererClass);
//    }
//
//    /**
//    * Get renderer class name
//    *
//    * @param string $componentClass
//    * @param string $rendererType
//    * @param bool $useDefaultIfNothingFound
//    * @return string
//    * 
//    * @throws Adept_Exception If renderer not found and $useDefaultIfNothingFound is false
//    */
//    public function getRendererClass($componentClass, $rendererType = null, $useDefaultIfNothingFound = true)
//    {
//        if (is_null($rendererType)) {
//            $rendererType = self::DEFAULT_TYPE;
//        }
//        
//        $rendererType = strtolower($rendererType);
//        
//        $class = isset($this->rendererClasses[$rendererType][$componentClass]) ?
//            $this->rendererClasses[$rendererType][$componentClass] : null;
//                
//        if ($class === null && $useDefaultIfNothingFound) {
//            $class = isset($this->rendererClasses[self::DEFAULT_TYPE][$componentClass]) ?
//                $this->rendererClasses[self::DEFAULT_TYPE][$componentClass] : null;
//        }
//        
//        if ($class === null) {
//            throw new Adept_Exception("Renderer for component [{$componentClass}], "
//            . " rendererType: [{$rendererType}] not found");
//        }
//        return $class;
//    }

}