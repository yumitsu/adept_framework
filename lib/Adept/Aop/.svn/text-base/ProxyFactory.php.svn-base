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
 * @package    Adept_Aop
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */


class Adept_Aop_ProxyFactory
{
    /**
     * @var Adept_Aop_ProxyFactory
     */
    private static $instance = null;
    
    private $adviceArray;
    
    /**
     * @return Adept_Aop_ProxyFactory
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Adept_Aop_ProxyFactory();
        }
        return self::$instance;
    }
            
    public function addAdvice($advice, $id)
    {
        $this->adviceArray[$id] = $advice;
    }
    
    public function getAdvicedObject($object)
    {
        return new Adept_Aop_AnnotatedProxyObject($object, $this->adviceArray);
    }
    
}
