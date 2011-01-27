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
 * Adept Date/time component wrapper for Zend_Date.
 * 
 * Extended by miscellaneous methods.
 */

class Adept_Date extends Zend_Date 
{

    /**
     * @return Adept_Date
     */
    static function now($locale = null)
    {
        return new self(null, null, $locale);
    }
    
    /**
     * Compare date only (day, month, year)
     *
     * @param Adept_Date $date
     */
    public function compareDate($date)
    {
        // ??? compareDate in Zend_Date ???
        $result = $this->compare($date->getYearValue(), self::YEAR);
        if ($result == 0) {
            $result = $this->compare($date->getMonthValue(), self::MONTH);
            if ($result == 0) {
                $result = $this->compare($date->getDayValue(), self::DAY);
            }
        }
        return $result;
    }
    
    /**
     * @return Adept_Date
     */
    public function fromSql($sqlDate)
    {
        if (is_numeric($sqlDate)) {
            $this->setTimestamp((int) $sqlDate);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function toSql()
    {
    	return $this->toString('YYYY-MM-dd HH:mm:ss');
    }
    
    /**
     * @return Adept_Date
     */
    public function setDayBeginning()
    {
        $this->setHourValue(0);
        $this->setMinuteValue(0);
        $this->setSecondValue(0);
        return $this;
    }
    
    /**
     * @return Adept_Date
     */
    public function setDayEnd()
    {
        $this->setHourValue(23);
        $this->setMinuteValue(59);
        $this->setSecondValue(59);
        return $this;
    }
    
    // Predefined date formaters -----------------------------------------------
    
    public function toShortDate()
    {
    	return $this->toString('dd.MM.YYYY');
    }
    
    public function toLongDate()
    {
        return $this->toString('dd.MM.YYYY');
    }
    
    public function toShortTime()
    {
    	return $this->toString('HH:mm');
    }
    
    public function getDayValue()
    {
        return $this->get(self::DAY);
    }
    
    public function setDayValue($day)
    {
        $this->set($day, self::DAY);
    }
    
    public function getMonthValue()
    {
        return $this->get(self::MONTH);
    }
    
    public function setMonthValue($month)
    {
        $this->set($month, self::MONTH);
    }
    
    public function getYearValue()
    {
        return $this->get(self::YEAR);
    }
    
    public function setYearValue($year)
    {
        $this->set($year, self::YEAR);
    }
    
    public function getSecondValue()
    {
        return $this->get(self::SECOND);
    }
    
    public function setSecondValue($second)
    {
        $this->set($second, self::SECOND);
    }
    
    public function getMinuteValue()
    {
        return $this->get(self::MINUTE);
    }
    
    public function setMinuteValue($minute)
    {
        $this->set($minute, self::MINUTE);
    }
    
    public function getHourValue()
    {
        return $this->get(self::HOUR);
    }
    
    public function setHourValue($hour)
    {
        $this->set($hour, self::HOUR);
    }
    
}