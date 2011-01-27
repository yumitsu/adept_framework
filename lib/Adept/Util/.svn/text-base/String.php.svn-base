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

class Adept_Util_String 
{

    static public function toUnderScoresNotation($source, $upperLetter = false)
    {
        if ($upperLetter) {
            return ucfirst(ltrim(preg_replace('~([a-z])?([A-Z])([a-z])~e', "'\\1_'.('\\2').'\\3'", $source), '_'));
        }
        return ltrim(preg_replace('~([a-z])?([A-Z])([a-z])~e', "'\\1_'.strtolower('\\2').'\\3'", $source), '_');
    }

    static public function toCamelNotation($source, $upperFirstLetter = false)
    {
        $res = preg_replace('~([a-zA-Z])?_([a-zA-Z])~e',
                            "'\\1'.strtoupper('\\2')",
                            $source);
        return ($upperFirstLetter) ? ucfirst($res) : $res;
    }
    
    static function fillPlaces($pattern, $parameters, $placeSeparatorChar = '%')
    {
        $verbatim = false;
        if ($pattern instanceof Adept_Verbatim) {
            $pattern = $pattern->toString();
            $verbatim = true;
        }
        foreach ($parameters as $key => $value) {
            $pattern = str_ireplace($placeSeparatorChar . $key . $placeSeparatorChar, $value, $pattern);            
        }
        return ($verbatim) ? new Adept_Verbatim($pattern) : $pattern;
    }
    
    
    static function getNumberDependedString($number, $titles)
    {
        $cases = array (2, 0, 1, 1, 1, 2);
        return $number." ".$titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
    }

    static function truncate($string, $length = 80, $etc = '...', $break_words = false)
    {
        if ($length <= 0) {
            return '';
        }

        $verbatim = false;
        if ($string instanceof Adept_Verbatim) {
            $string = $pattern->toString();
            $verbatim = true;
        }
        
        if (strlen($string) > $length) {
            $length -= strlen($etc);
            $string = html_entity_decode($string);
            if (!$break_words) {
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
            }
            $string = substr($string, 0, $length) . $etc; 
        } 
        
        return ($verbatim) ? new Adept_Verbatim($string) : $string;
    }
 
 
    static public function lvdate($time)
    {
        $dateTime = new Adept_Date($time);
        
        $format = 'H:i';
        $prefix = '';
        
        if ($dateTime->isTomorrow()) {
            $prefix = "завтра в ";
        } elseif($dateTime->isYesterday()) {
            $prefix = "вчера в ";
        } elseif ($dateTime->isToday()) {
            if ($dateTime->isLater(Adept_Date::now()->subMinute(59))) {
                $format = "";
                if ($dateTime->isLater(Adept_Date::now()->subMinute(1))) {
                    if ($dateTime->isLater(Adept_Date::now()->subSecond(15))) {
                        $prefix = "только что";
                    } else {
                        $secs = Adept_Date::now()->subSecond($dateTime->getSecond())->toString('s');
                        $prefix = self::plural($secs,' секунду', ' секунды', ' секунд') . ' назад';
                    }
                } else {
                    $minutes = (int)Adept_Date::now()->subMinute($dateTime->getMinute())->get(Zend_Date::MINUTE);
                    $prefix = self::plural($minutes,' минуту', ' минуты', ' минут', ' ') . ' назад';
                }
            } else {
                $prefix = "сегодня в ";
            }
        } else {
            $format = "j M Y в H:i";
        }
        
        $locale = new Zend_Locale('ru_RU');
        if (strpos($format, 'F') !== null) {
            $ruFullMonthName = iconv('UTF-8', 'cp1251', $dateTime->toString('F', 'php', $locale));
            $format = str_replace('F', $ruFullMonthName, $format);
        }

        if (strpos($format, 'M') !== null) {        
            $ruShortMonthName = iconv('UTF-8', 'cp1251', $dateTime->toString('M', 'php', $locale));
            $format = str_replace('M', substr($ruFullMonthName, 0, 3), $format);
        }
        
        return $prefix . "" . ($format ? $dateTime->toString($format, 'php', $locale) : '');
    }   

    /**
     * Example of usage: Adept_Util_String::plural($message_count,' запись',' записи',' записей',' записей')
     *
     * @param unknown_type $count
     * @param unknown_type $form1
     * @param unknown_type $form2
     * @param unknown_type $form3
     * @param unknown_type $nullForm
     * @return unknown
     */
    static function plural($count, $form1, $form2 = null, $form3 = null, $nullForm = null){
        if(!$count && !is_null($nullForm)){
            return $nullForm;
        }
        $form2 = is_null($form2) ? $form1 : $form2;
        $form3 = is_null($form3) ? $form2 : $form3;
        
        return Adept_Util_String::getNumberDependedString($count, array($form1, $form2, $form3));
    }
    
    static function isUTF8($string)
    {
        return ($string === mb_convert_encoding(
            mb_convert_encoding($string, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32'));
    }
    
}