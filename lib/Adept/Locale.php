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

class Adept_Locale extends Zend_Locale 
{

    /**
     * @var string
     */
    static private $defaultLocale;
    
    /**
     * @var array
     */
    static private $instances = array();
    
    static private $detectOrder = null;

    /**
     * @see Zend_Locale::getDefault to understand how locale detection works.
     * 
     * @param array $detectOrder 
     */
    static public function init($detectOrder = null)
    {
        self::$detectOrder = $detectOrder;
    }

    /**
     * Returns locale instance.
     *
     * @param string $locale Locale string; null if use default locale.
     * @return Adept_Locale
     */
    static public function getInstance($locale = null) 
    {
        if (null == $locale) {
            if (null == self::$defaultLocale) {
                self::$defaultLocale = self::detectDefaultLocale(self::$detectOrder);
            }
            $locale = self::$defaultLocale;
        } 
        
        if (!isset(self::$instances[$locale])) {
            self::$instances[$locale] = new self($locale);
        }
        return self::$instances[$locale];
    }
    
    /**
     * @param array $detectOrder
     * @return string
     * 
     * @throws Adept_Exception If detection fault.
     */
    static private function detectDefaultLocale($detectOrder = null)
    {
        $locale = new Zend_Locale();
        $defaults = array_keys($locale->getDefault($detectOrder));
        if (!is_array($defaults) || count($defaults) == 0) {
            throw new Adept_Exception('Cannot detect default locale');
        }
        return $defaults[0];
    }
    
    protected static function getApplicationEncoding()
    {
        $app = Adept_Context::getInstance()->getApplication();
        if ($app != null) {
            return $app->getEncoding();
        }
        return null;
    }
    
    public static function getTranslationList($type = null, $locale = null)
    {
        $result = parent::getTranslationList($type, $locale);
        $encoding = self::getApplicationEncoding();
        if ($encoding !== null || $encoding !== Adept_Util_Encoding::UTF8) {
            $result = Adept_Util_Encoding::convert(Adept_Util_Encoding::UTF8, $encoding, $result);
        } 
        return $result;
    }
    
    public static function setDefaultLocale($defaultLocale)
    {
        self::$defaultLocale = $defaultLocale;
    }
        
}
