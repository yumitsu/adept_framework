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

class Adept_Util_Serializer
{

    protected $subject;
    protected $serialized;
    protected $classPaths = array();

    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        if ($this->serialized) {
            $this->_includeFiles();
            $this->subject = unserialize($this->serialized);
            $this->serialized = null;
        }
        return $this->subject;
    }

    public function getClassPaths()
    {
        return $this->classPaths;
    }

    public function __sleep()
    {
        if (is_null($this->serialized)) {
            $this->serialized = serialize($this->subject);
            $this->fillClassPathInfo($this->serialized);
        }
        return array('serialized', 'classPaths');
    }

    public function _includeFiles()
    {
        foreach($this->classPaths as $path) {
            if ($path) {
                require_once($path);
            }
        }
    }

    private function fillClassPathInfo($serialized)
    {
        $classes = self::extractSerializedClasses($serialized);
        $this->class_paths = array();

        foreach($classes as $class) {
            $reflect = new ReflectionClass($class);
            $this->classPaths[] = $reflect->getFileName();
        }
    }

    static function extractSerializedClasses($str)
    {
        $extract_class_names_regexp = '~([\||;]O|^O):\d+:"([^"]+)":\d+:\{~';
        if (preg_match_all($extract_class_names_regexp, $str, $m)){
            return array_unique($m[2]);
        } else {
            return array();
        }
    }

}
