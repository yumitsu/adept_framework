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

/**
 * Adept wrapper for Json features. 
 */
class Adept_Json 
{

    const TYPE_ARRAY  = 1;
    const TYPE_OBJECT = 0;
    
    /**
     * Use Zend_Json_Decoder and Zend_Json_Encoder anyway. 
     *
     * @var bool
     */
    protected static $forceZendCoder = true;

    static function decode($encoded, $decodeType = self::TYPE_ARRAY)
    {
        if (!self::$forceZendCoder && function_exists('json_decode')) {
            return json_decode($encoded, $decodeType == self::TYPE_ARRAY);
        }
        return Zend_Json_Decoder::decode($encoded, $decodeType);
    }

    static function encode($decoded, $cycleCheck = false)
    {
        if (!self::$forceZendCoder && function_exists('json_encode')) {
            return json_encode($decoded);
        }
        return Zend_Json_Encoder::encode($decoded, $cycleCheck);
    }
    
}
