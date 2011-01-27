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

class Adept_Cache
{

    /**
     * @var Adept_Map
     */
    protected $config;
    
    /**
     * Cache services. 
     * 
     * @var Adept_Map
     */
    protected $services = array();
    
    /**
     *  @var Adept_Cache
     */
    static protected $instance;
    
    protected $defaultFrontend = 'Core';
    protected $defaultBackend = 'File';
    
    protected function __construct()
    {
        $this->services = new Adept_Map();
        $this->config = new Adept_Map();
    }
    
    /**
     * @return Adept_Cache
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Configure factory.
     *
     * @param Adept_Config $config
     */
    public function init($config)
    {
        foreach ($config->getAsList('cache') as $cache) {
            
            $frontendOptions = $cache->get('frontend_options', array());
            if ($frontendOptions instanceof Adept_Config) {
                $frontendOptions = $frontendOptions->toArray();
            }
            
            $backendOptions = $cache->get('backend_options', array());
            if ($backendOptions instanceof Adept_Config) {
                $backendOptions = $backendOptions->toArray();
            }
            // Register services
            $this->addService($cache->get('id'), $cache->get('frontend'), $cache->get('backend'),
               $frontendOptions, $backendOptions);
        }
    }
    
    public function addService($serviceId, $frontend = null, $backend = null, $frontendOptions = array(), $backendOptions = array())
    {
        if ($this->config->has($serviceId)) {
            // Service already added
            return ;
        }

        if (null == $frontend) {
            $frontend = $this->defaultFrontend;
        }
        
        if (null == $backend) {
            $backend = $this->defaultBackend;
        }
        
        $frontendOptions['automatic_serialization'] = true;
        
        $serviceConfig = array(
           'frontend' => $frontend,
           'backend' => $backend,
           'frontendOptions' => $frontendOptions,
           'backendOptions' => $backendOptions,
        );
        
        $this->config->set($serviceId, $serviceConfig);
    }
    
    /**
     * @param string $serviceId Cache service id. 
     *  
     * @return Zend_Cache_Core
     */
    public function getService($serviceId)
    {
        if ($this->services->has($serviceId)) {
           return $this->services->get($serviceId);
        }
        
        // Create new cache service
        $config = $this->config->get($serviceId);
        if (null === $config) {
            return null;
        }
        
        $service = Zend_Cache::factory(
            $config['frontend'], $config['backend'], 
            $config['frontendOptions'], $config['backendOptions']);

        $this->services->set($serviceId, $service);
        return $service;
    }
    
    /**
     * @param string $serviceId Cache service id. 
     *  
     * @return array 
     */
    public function getServiceConfig($serviceId)
    {
        // Create new cache service
        $config = $this->config->get($serviceId);
        if (null === $config) {
            return null;
        }
        return $config instanceof Adept_Config ? $config->toArray() : $config;
    }
    
    public function cleanAll()
    {
        foreach (array_keys($this->config) as $serviceId) {
            $this->getService($serviceId)->clean();    
        }
    }    
    
}