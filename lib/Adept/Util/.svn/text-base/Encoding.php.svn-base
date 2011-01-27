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
 * @package    Adept_Util
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Util_Encoding 
{

    const UTF8 = 'UTF-8';

    static public function convert($from, $to, $source)
    {
        if (is_array($source)) {
            $result = array();
            foreach ($source as $key => $item) {
                $result[$key] = self::convert($from, $to, $item);
            }
            return $result;
        } elseif (is_string($source)) {
            return iconv($from, $to, $source);
        } else {
            return $source;
        }
    }

}