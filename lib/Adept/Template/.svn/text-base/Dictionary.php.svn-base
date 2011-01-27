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
 * @package    Adept_Template
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Template_Dictionary 
{
    
    /**
     * @var Adept_CanonicalMap
     */
    protected $libraries;

    /**
     * @var Adept_Map
     */
    static $defaultLibraries = null;
    
    /**
     * @var Adept_Template_Dictionary
     */
    protected static $instance;
    
    public function __construct()
    {
        $this->libraries = new Adept_CanonicalMap(self::$defaultLibraries);
    }
    
    /**
     * @return Adept_Template_Dictionary
     */
    static public function getInstance() 
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    static public function createInstance()
    {
        return new self();
    }

    static public function addDefaultLibrary($prefix, $libraryOrPath)
    {
        if (is_string($libraryOrPath)) {
            $library = new Adept_Template_TagLibrary();
            $library->loadFromTld($libraryOrPath);
        } elseif ($library instanceof Adept_Template_TagLibrary) {
            $library = $libraryOrPath;
        } else {
            throw new Adept_Exception_IllegalArgument('$libraryOrPath contains wrong value');
        }
        self::$defaultLibraries[$prefix] = $library;
    }
    
    public function importLibrary($prefix, $uri) 
    {
        // TODO Check uri specific
        $library = new Adept_Template_TagLibrary();
        $library->loadFromTld($uri);
        $this->libraries[$prefix] = $library;
    }
    
    public function hasTag($fullTag)
    { 
        list($prefix, $tag) = explode(':', fullTag, 2);
        if (!$this->hasLibrary($prefix)) {
            return false;
        }
        return $this->libraries->get($prefix)->getTagInfo($tag) != null;
    }
    
    public function hasLibrary($prefix)
    {
        return $this->libraries->has($prefix);
    }
    
    /**
     * @param string $prefix
     * @return Adept_Template_TagLibrary
     */
    public function getLibrary($prefix)
    {
        return $this->libraries->get($prefix);
    }
    
}