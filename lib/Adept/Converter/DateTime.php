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

class Adept_Converter_DateTime extends Adept_Converter_Abstract 
{

    public function getAsModel($sender, $value)
    {
        $dateTime = Adept_Date::now();

        if (preg_match('~(\d+)\.(\d+)\.(\d+)~', $value, $match)) {
            $dateTime->setYearValue($match[3]);
            $dateTime->setMonthValue($match[2]);
            $dateTime->setDayValue($match[1]);
        }
//        if (!$dateTime->validate()) {
//            $title = $this->getComponentTitle($sender);
//            throw new Adept_Converter_Exception('Wrong date given at field "{$field}"', Adept_Message::ERROR, 
//                array('field' => $title));
//        }
        return $dateTime;
    }

    /**
     * @param Adept_Component_AbstractComponent $sender
     * @param Adept_Date $value
     * @return string
     */
    public function getAsView($sender, $value)
    {
        if (!$value instanceof Adept_Date) {
            $value = Adept_Date::now();
        }
        return $value->toString($this->getFormat());
    }

    public function getFormat()
    {
        return $this->getParameter('format', 'dd.MM.YYYY');
    }
    
    public function setFormat($format)
    {
        $this->setParameter('format', $format);
    }

}
