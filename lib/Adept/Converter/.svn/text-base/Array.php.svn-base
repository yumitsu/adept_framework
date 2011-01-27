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

class Adept_Converter_Array extends Adept_Converter_Abstract
{
    const SPLITTER_PARAMETER = 'splitter';
    const VALUE_PROPERTY_PARAMETER = 'valueProperty';
    const TITLE_PROPERTY_PARAMETER = 'titleProperty';

    public function getAsModel($sender, $value)
    {
        $array = explode($this->getSplitter(), $value);
        $result = Array();
        for ($i = 0; $i < count($array); $i++) {
            if (trim($array[$i]) != '') {
                $result[$i] = trim($array[$i]);
            }
        }
        return $result;
    }

    public function getAsView($sender, $value)
    {
        if (is_array($value)) {
            $itemsArray = new Adept_Converter_ItemsArray($value, $this->getTitleProperty(), $this->getValueProperty());
            $result = Array();
            foreach ($itemsArray as $key => $item) {
                $result[$key] = $item;
            }
            return implode($this->getSplitter() . ' ', $result);
        }
        else {
            return '';
        }
    }

    public function getSplitter()
    {
        return $this->getParameter(self::SPLITTER_PARAMETER, ',');
    }

    public function getValueProperty()
    {
        return $this->getParameter(self::VALUE_PROPERTY_PARAMETER, null);
    }

    public function getTitleProperty()
    {
        return $this->getParameter(self::TITLE_PROPERTY_PARAMETER, null);
    }

}