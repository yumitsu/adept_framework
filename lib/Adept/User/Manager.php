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
 * @package    Adept_User
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_User_Manager
{

    /**
     * @var Adept_User_Adapter_Interface
     */
    protected $adapter = null;

    protected static $instance = null;

    /**
     * @var Adept_User_IUser
     */
    protected $currentUser;

    protected $loggedIn = false;

    protected $options = array(
        'sessionKey' => 'logged_in_user',
        'cookieDomain' => null,
        'cookieLogin' => 'justAMagicVar',
        'cookieLifetime' => 2592000, // one month
        'cookiePassword' => 'MAGIC_COOKIE_SALT_FjHi8n',
        'passwordSalt' => 'PASSWORD_SALT_k6L$3',
        'hashSalt' => 'HASH_SALT_lEf83Nf3#gf',
        'encodePassword' => true,
    );

    /**
     * @return Adept_User_Manager
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function autoLogin()
    {
        $request = Adept_Context::getInstance()->getRequest();
        $response = Adept_Context::getInstance()->getResponse();

        if (!$request->hasCookie($this->getCookieLogin()) || !$request->hasCookie($this->getCookiePassword())) {
            return false;
        }

        $login = $request->getCookie($this->getCookieLogin());
        $password = $request->getCookie($this->getCookiePassword());

        $user = $this->adapter->findUserByLogin($login);

        if ($user == null) {
            throw new Adept_User_LoginException('Invalid login or password');
        }

        if ($this->isEncodePassword()) {
            $checkPassword = $user->getPassword();
        } else {
            $checkPassword = $this->encodePassword($user->getPassword());
        }

        if ($password != $checkPassword) {
            throw new Adept_User_LoginException('Invalid login or password');
        }

        $this->currentUser = $user;
        $this->loggedIn = true;
        $this->getSession()->setValue($this->getSessionKey(), $this->currentUser->getId());

        return true;
    }

    public function encodePassword($decodedPassword)
    {
        return md5($decodedPassword . $this->getHashSalt());
    }

    public function login($login, $decodedPassword, $saveInCookie = false)
    {
        if ($this->isEncodePassword()) {
            $encodedPassword = $this->encodePassword($decodedPassword);
        } else {
            $encodedPassword = $decodedPassword;
        }
        $this->loginByEncodedPassword($login, $encodedPassword, $saveInCookie);
        
    }

    /**
     * @param string $login
     * @param string $encodedPassword
     * @param boolean $safeInCookie
     */
    public function loginByEncodedPassword($login, $encodedPassword, $saveInCookie = false)
    {
        $user = $this->adapter->findUserByLoginAndPassword($login, $encodedPassword);
        if ($user == null) {
            throw new Adept_User_LoginException('Invalid login or password');
        }

        if ($user->isActivated() == false) {
            throw new Adept_User_LoginException('User not activated', Adept_User_LoginException::NOT_ACTIVATED);
        }

        $this->currentUser = $user;
        $this->loggedIn = true;
        if ($saveInCookie) {
            $cookiePassword = ($this->isEncodePassword()) ? $encodedPassword : $this->encodePassword($encodedPassword);
            $this->saveUserCookie($login, $cookiePassword);
        }

        $this->getSession()->setValue($this->getSessionKey(), $this->currentUser->getId());
    }

    protected function saveUserCookie($login, $encodedPassword)
    {
        $response = Adept_Context::getInstance()->getResponse();
        $domain = $this->getCookieDomain();
        if ($domain != null) {
            $response->setCookie($this->getCookieLogin(), $login, time() + $this->getCookieLifetime(), '/', $domain);
            $response->setCookie($this->getCookiePassword(), $encodedPassword, time() + $this->getCookieLifetime(), '/', $domain);
        } else {
            $response->setCookie($this->getCookieLogin(), $login, time() + $this->getCookieLifetime(), '/');
            $response->setCookie($this->getCookiePassword(), $encodedPassword, time() + $this->getCookieLifetime(), '/');
        }
    }

    public function restore()
    {
        $id = $this->getSession()->getValue($this->getSessionKey());
        
        if ($id == null) {
            $this->loggedIn = false;
            return false;
        }

        $user = $this->adapter->findUserById($id);
        if ($user != null) {
            $this->currentUser = $user;
            $this->loggedIn = true;
            return true;
        }
        return false;
    }

    public function logout()
    {
        $this->currentUser = $this->adapter->createAnonymousUser();
        
        $domain = $this->getCookieDomain();

        $response = Adept_Context::getInstance()->getResponse();
        $response->removeCookie($this->getCookieLogin(), '/', $domain);
        $response->removeCookie($this->getCookiePassword(), '/', $domain);

        $this->getSession()->removeValue($this->getSessionKey());
        
        $this->loggedIn = false;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    public function getCurrentUser()
    {
        if ($this->currentUser == null) {
            $this->currentUser = $this->adapter->createAnonymousUser();
        }
        return $this->currentUser;
    }

    public function setCurrentUser($user)
    {
        $this->currentUser = $user;
    }

    public function getSessionKey()
    {
       return $this->options['sessionKey'];
    }

    public function getCookieDomain()
    {
        return $this->options['cookieDomain'];
    }

    public function getCookieLogin()
    {
        return $this->options['cookieLogin'];
    }

    public function getCookieLifetime()
    {
        return $this->options['cookieLifetime'];
    }

    public function getCookiePassword()
    {
        return $this->options['cookiePassword'];
    }

    public function getPasswordSalt()
    {
        return $this->options['passwordSalt'];
    }

    public function getHashSalt()
    {
        return $this->options['hashSalt'];
    }

    public function isEncodePassword()
    {
        return $this->options['encodePassword'];
    }

    public function isLoggedIn()
    {
        return $this->loggedIn;
    }

    public function setOptions($options)
    {
        foreach ($options as $key => $value) {
            $this->options[$key] = $value;
        }
    }

    /**
     * Возвращает сессию пользователя
     *
     * @return Adept_Session_Http
     */
    public function getSession()
    {
        return Adept_Context::getInstance()->getSession();
    }

}
