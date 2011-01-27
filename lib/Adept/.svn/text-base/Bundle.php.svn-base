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

class Adept_Bundle 
{
    
    const DEFAULT_GROUP = 'default';
    const USE_DEFAULT_LOCALE = null;
    
    static protected $instance = null;
    
    protected $strings;
    
    public function __construct() {
    }
    
    /**
     * @return Adept_Bundle
     */
    static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;            
    }
    
    protected function loadBundleFile($group, $locale)
    {
        $locator = new Adept_Bundle_Locator();
        $file = $locator->locate($group, array(Adept_Bundle_Locator::LOCALE_PARAM  => $locale));
        
        if ($file) { 
            $ini = Adept_ConfigLoader::getInstance()->load($file);
            $this->strings[$group] = $ini->toArray();
            return true;
        } else {
            return false;
        }
    }
    
    static function get($key, $group = self::DEFAULT_GROUP, $locale = self::USE_DEFAULT_LOCALE)
    {
        $instance = self::getInstance();
        
        if ($locale == self::USE_DEFAULT_LOCALE) {
            $locale = Adept_Locale::getInstance()->toString();
        }
//        FIXME detect locale correctly
        $locale = explode('_', $locale);
        
        if (!isset($instance->strings[$group]))    {
            if (!$instance->loadBundleFile($group, $locale[0])) {
                return $key;
            }
        }
        
        $message = isset($instance->strings[$group][$key]) ? $instance->strings[$group][$key] : $key;
        $encoding = strtolower(Adept_Context::getInstance()->getApplication()->getEncoding());
        if ($encoding != 'cp1251' && $encoding != 'windows-1251') {
            $message = Adept_Util_Encoding::convert('cp1251', $encoding, $message);
        }
        
        return $message;
    }
    
}
