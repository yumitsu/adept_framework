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
 * @package    Adept_Filter
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Filter_Cache implements Adept_Filter_Interface
{

    /**
    * @param Adept_Filter_Chain $chain
    */
    protected $config;

    public function __construct($config = null)
    {
        if (!is_null($config)) {
            $this->config = Adept_ConfigLoader::getInstance()->load($config);
        } else {
            $this->config = Adept_ConfigLoader::getInstance()->load('cache.xml');
        }
    }

    public function init($config)
    {
    }
    
    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function process($chain)
    {
        $cache = Adept_Cache::getInstance()->init($this->config);
        $chain->next();
    }
    
}