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
 * @package    Adept_Session
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Session_Http extends Adept_Session_Abstract 
{

    protected $id;

    private $options = array(
        'cookie_lifetime' => null,
        'cookie_path'     => '/',
        'cookie_domain'   => null,
        'cookie_secure'   => null,
    );

    static $instance;

    public function __construct()
    {
    }

    /**
     * @deprecated Use Adept_Context->getHttpSession() 
     */
    static public function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param array $newOptions
     */
    public function setOptions($newOptions)
    {
        foreach ($newOptions as $name => $value) {
            $name = strtolower($name);
            if (array_key_exists($name, $this->options)) {
                $this->options[$name] = $value;
            } else {
                throw new Adept_Exception("Unknown option: {$name} = {$value}");
            }
        }
    }
    
    /**
     * Checks is session started.
     * 
     * @return bool
     */
    public function isStarted()
    {
        return (session_id()) ? true : false;
    }

    public function getId()
    {
        return $this->id;
    }
    
    protected function configureSession()
    {
        if ($this->isStarted()) {
            throw new Adept_Exception('Session already started. Cannot change session options.');
        }
        
        if ($this->options) {
            // Init session options
            foreach ($this->options as $name => $value) {
                ini_set('session.' . $name, $value);
            }
        }
    }

    public function start($sessionId = null)
    {
        if ($this->isStarted()) {
            return false;
        }

        if ($sessionId != null) {
            session_id($sessionId);
        }

        $this->configureSession();
        
        session_start();
        $this->id = session_id();
        return true;
    }

    public function close()
    {
        setcookie('PHPSESSID', 0, time() - 3600, $this->options['cookie_path'], $this->options['cookie_domain'], 
            $this->options['cookie_secure']);
            
        session_destroy();
    }

    public function get($name)
    {
        if (!$this->isStarted()) {
            $this->start();
        }
        if (isset($_SESSION[$name])) {
            $value = $_SESSION[$name];
            if ($value instanceof Adept_Util_Serializer) {
                $object = $value->getSubject();
                return $object;
            } else {
                return $value;
            }
        } else {
            return null;
        }
    }

    public function set($name, $value)
    {
        if (!$this->isStarted()) {
            $this->start();
        }
        if (is_object($value)) {
            $serializer = new Adept_Util_Serializer($value);
            $_SESSION[$name] = $serializer;
        } else {
            $_SESSION[$name] = $value;
        }
    }

    public function has($name)
    {
        return isset($_SESSION[$name]);
    }

    public function remove($name)
    {
        if (isset($_SESSION[$name])) {
            session_unregister($name);
            unset($_SESSION[$name]);
        }
    }
    
    /**
     * @deprecated Use method get instead
     */
    public function getValue($name)
    {
        return $this->get($name);
    }
    
    /**
     * @deprecated Use method has instead
     */
    public function hasValue($name)
    {
        return $this->has($name);
    }
    
    /**
     * @deprecated Use method set instead
     */
    public function setValue($name, $value)
    {
        $this->set($name, $value);
    }
    
    /**
     * @deprecated Use method remove instead
     */
    public function removeValue($name)
    {
        $this->remove($name);
    }

}