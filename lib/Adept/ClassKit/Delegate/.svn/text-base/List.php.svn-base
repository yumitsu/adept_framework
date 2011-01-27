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
 * @package    Adept_ClassKit
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_ClassKit_Delegate_List 
{

    /**
     * @param array|object $list List of {@link Adept_ClassKit_Delegate_Interface} objects
     * @param array $args Array of arguments
     * @return mixed Returns result of invoke call if $list is an object
     */
    public static function invokeAll($list, $args) 
    {
        if (is_array($list)) {
            foreach ($list as $delegate) {
                $delegate->invoke($args);
            }
        } elseif (is_object($list)) {
            return $list->invoke($args);
        }
        return null;
    }

    /**
     * Ivokes one by one delegate while result of invoke is null; otherwise return it.
     * 
     * @param array|object $list List of {@link Adept_ClassKit_Delegate_Interface} objects
     * @param array $args Array of arguments
     * 
     * @return mixed Returns result of invoke 
     */
    public static function invokeChain($list, $args) 
    {
        $result = null;
        
        if (is_array($list)) {
            foreach ($list as $delegate) {
                $result = $delegate->invoke($args);
                if ($result != null) {
                    break ;
                }
            }
        } elseif (is_object($list)) {
            $result = $list->invoke($args);
        }
        return $result;
    }

}
