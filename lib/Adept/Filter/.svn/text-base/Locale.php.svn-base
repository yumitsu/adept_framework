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

class Adept_Filter_Locale extends Adept_Filter_Abstract 
{

    protected $defaultTimeZone = 'Europe/Moscow';
    protected $defaultLocale = 'ru_RU';
    
    public function init($config)
    {
        if (!$config instanceof Adept_Config) {
            $config = Adept_ConfigLoader::getInstance()->load($config);
        }
        if ($config->has('defaultTimeZone')) {
            $this->defaultTimeZone = $config->get('defaultTimeZone');
        }
        if ($config->has('defaultLocale')) {
            $this->defaultLocale = $config->get('defaultLocale');
        }
    }

    public function process($chain)
    {
        date_default_timezone_set($this->defaultTimeZone);
        
        // @todo Setup locale environment
//         setlocale(LC_ALL, $this->defaultLocale);
            Adept_Locale::setDefaultLocale($this->defaultLocale);
        
        $chain->next();
    }

}