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

/**
 * @todo Refactoring
 */
class Adept_Converter_ItemsArray extends ArrayObject
{
    protected $valueProperty;
    protected $titleProperty;
    
    public function __construct($items, $titleProperty, $valueProperty = null)
    {
        $this->valueProperty = $valueProperty;
        $this->titleProperty = $titleProperty;
        parent::__construct($this->fetch($items));
    }

    protected function fetch($items)
    {
        $result = array();
        foreach ($items as $key => $value) {
            if (is_object($value)) {
                $titleOfItem = Adept_Binding_Util::getPropertyValue($value, $this->titleProperty);
                
                if (is_null($this->valueProperty)) {
                    $result[$key] = $titleOfItem;
                }
                else {
                    $valueOfItem = Adept_Binding_Util::getPropertyValue($value, $this->valueProperty);
                    $result[$valueOfItem] = $titleOfItem;
                }
            }
            else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

}