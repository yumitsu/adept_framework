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
 * @package    Adept_Converter
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Converter_Url extends Adept_Converter_Abstract
{

    public function getAsModel($sender, $value)
    {
        try {
            if(strpos($value, "http://") === false 
                && strpos($value, 'https://') === false && strpos($value, "ftp://") === false){
                $value = "http://" . $value;
                
            }
            $url = Zend_Uri::factory($value);
        } catch (Exception $e) {
            $title = $this->getComponentTitle($sender);
            throw new Adept_Converter_Exception("Wrong url given at field '%field%'",
                Adept_Message::ERROR, Array('field' => $title));
        }
        return $url;
    }

    /**
     * @param Zend_Uri_Http $value
     */
    public function getAsView($sender, $value)
    {
        if (is_string($value)) {
            return $value;
        } elseif ($value instanceof Zend_Uri_Http) {
            return $value->__toString();
        } else {
            return '';
        }
    }

}