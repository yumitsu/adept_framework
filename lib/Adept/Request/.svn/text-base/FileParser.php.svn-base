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
 * @package    Adept_Request
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Request_FileParser 
{

    function parseFiles($files) 
    {
        $result = array();
        foreach ($files as $key => $data) {
            //$this->key = array();
            if ($this->_isSingleFile($data)) {
                $result[$key] = $data;
            } else {
                $result[$key] = $this->_parseComplex($data);
            }
        }
        return $result;
    }

    function _parseComplex($data) 
    {
        $result = array();
        foreach ($data as $dataKey => $dataValue) {
            foreach ($dataValue as $key => $value) {
                $this->_parsePropertyRecursive($result[$key], $dataKey, $value);
            }
        }
        return $result;
    }

    function _isSingleFile($data) 
    {
        return
        (isset($data['name'])) && (!is_array($data['name'])) &&
        (isset($data['error'])) && (!is_array($data['error'])) &&
        (isset($data['type'])) && (!is_array($data['type'])) &&
        (isset($data['size'])) && (!is_array($data['size'])) &&
        (isset($data['tmp_name'])) && (!is_array($data['tmp_name']));
    }

    function _parsePropertyRecursive(&$result, $propertyName, $data) 
    {
        if (!is_array($data)) {
            $result[$propertyName] = $data;
        } else {
            foreach ($data as $dataKey => $dataValue) {
                $this->_parsePropertyRecursive($result[$dataKey], $propertyName, $dataValue);
            }
        }
    }

}