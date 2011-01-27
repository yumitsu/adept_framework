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

class Adept_Converter_Number extends Adept_Converter_Abstract 
{
    const DECIMALS_PARAMETER = 'decimals';
    const DECIMAL_SEPARATOR_PARAMETER = 'decimalSeparator';
    const THOUSANDS_SEPARATOR_PARAMETER = 'thousandsSeparator';

    public function getAsModel($sender, $value) 
    {
        $value = str_replace($this->getThousandsSeparator(), "", $value);
        $value = str_replace($this->getDecimalSeparator(), ".", $value);
        return floatval($value);
    }

    public function getAsView($sender, $value)
    {
        return number_format($value, $this->getDecimals(), $this->getDecimalSeparator(),
            $this->getThousandsSeparator());
    }

    public function getDecimals()
    {
        return $this->getParameter(self::DECIMALS_PARAMETER, 3);
    }

    public function getDecimalSeparator()
    {
        return $this->getParameter(self::DECIMAL_SEPARATOR_PARAMETER, ',');
    }

    public function getThousandsSeparator()
    {
        return $this->getParameter(self::THOUSANDS_SEPARATOR_PARAMETER, ' ');
    }

}