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

require_once('Adept/User/IUser.php');

class Adept_User_Principle extends Adept_Db_CachedActiveRecord implements Adept_User_IUser
{
    const USER_SESSION_KEY = 'LOGGED_IN_USER';

    const COOKIE_LOGIN = 'project_login';
    const COOKIE_MAGIC_KEY = 'project_magic_key';
    const MAGIC_WORD = '_0123456789_magic_word_';
    const MAGIC_WORD2 = '_second_magic_word_';

    const INVALID_LOGIN_OR_PASSWORD = 1;
    const NOT_ACTIVATED = 2;
    const SUCCESS = 3;

    const TABLE_NAME = 'user';

    protected $encodePassword = true;

    protected $login;
    protected $password;
    protected $email;
    protected $locale;

    protected $loggedIn    = false;
    protected $activated = false;

    protected $_classProperties = array(
        'id' => array('column' => 'id'),
        'login' => array('column' => 'login'),
        'password' => array('column' => 'password'),
        'email' => array('column' => 'email'),
        'activated' => array('column' => 'is_activated'),
        'locale' => array('column' => 'locale'),
    );

    public function __construct($tableName = self::TABLE_NAME)
    {
        parent::__construct($tableName);
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if ($this->encodePassword) {
            $this->password = $this->encodePassword($password);
        } else {
            $this->password = $password;
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function isActivated()
    {
        return $this->activated;
    }

    public function setActivated($activated)
    {
        $this->activated = $activated;
    }

    public function isLoggedIn()
    {
        return $this->loggedIn;
    }

    public function encodePassword($password)
    {
        return md5($password . self::MAGIC_WORD);
    }

    public function autoLogin()
    {
        $request = Adept_Context::getInstance()->getRequest();
        $response = Adept_Context::getInstance()->getResponse();

        if (!$request->hasCookie(self::COOKIE_LOGIN) || !$request->hasCookie(self::COOKIE_MAGIC_KEY)) {
            return self::INVALID_LOGIN_OR_PASSWORD;
        }

        $login = $this->_quote($request->getCookie(self::COOKIE_LOGIN));
        $password = $this->_quote($request->getCookie(self::COOKIE_MAGIC_KEY));

        return $this->loginByEncodedPassword($login, $password);
    }

    private function _quote($string)
    {
        return $string;
    }

    public function login($login, $decodedPassword, $safeInCookie = false)
    {
        $login = mysql_escape_string($login);
        $decodedPassword = mysql_escape_string($decodedPassword);
        if ($this->encodePassword) {
            $encodedPassword = $this->encodePassword($this->_quote($decodedPassword));
        } else {
            $encodedPassword = $decodedPassword;
        }

        $result = $this->loginByEncodedPassword($login, $encodedPassword, $safeInCookie);
        if ($result == self::SUCCESS ) {
            $session = Adept_Context::getInstance()->getSession();

            $session->setValue(self::USER_SESSION_KEY, $this->getId());
            if ($safeInCookie) {
                $response = Adept_Context::getInstance()->getResponse();
                $response->setCookie(self::COOKIE_LOGIN, $login, time()+60*60*24*30, '/');
                $response->setCookie(self::COOKIE_MAGIC_KEY, $encodedPassword, time()+60*60*24*30,'/');
            }
        }
        return $result;
    }

    public function restore()
    {
        $session = Adept_Context::getInstance()->getSession();
        $id = $session->getValue(self::USER_SESSION_KEY);
        if ($id == null) {
            return false;
        }
        if ($this->loadById($id)) {
            $this->loggedIn = true;
            return true;
        }
        return false;
    }

    public function logout()
    {
        $this->login = null;
        $this->email = null;
        $this->password = null;
        $this->loggedIn = false;

        $request = Adept_Context::getInstance()->getRequest();
        $response = Adept_Context::getInstance()->getResponse();
        $session = Adept_Context::getInstance()->getSession();

        $session->removeValue(self::USER_SESSION_KEY);
        $response->removeCookie(self::COOKIE_LOGIN);
        $response->removeCookie(self::COOKIE_MAGIC_KEY);
        $session->close();
    }

    public function loginByEncodedPassword($login, $encodedPassword)
    {        
        $login = $this->_quote($login);
        $encodedPassword = $this->_quote($encodedPassword);

        $where = "login='{$login}' AND password='{$encodedPassword}'";
        if (!$this->loadByCondition($where)) {
            return self::INVALID_LOGIN_OR_PASSWORD ;
        }

        if ($this->activated == false) {
            return self::NOT_ACTIVATED ;
        }

        $this->loggedIn = true;

        return self::SUCCESS;
    }

    public function getUserByEmail($email)
    {
        return Adept_Db_ActiveRecord::findOne(get_class($this), "email = '{$email}'");
    }

    public function getUserByLogin($login)
    {
        $login = $this->_quote($login);
        return Adept_Db_ActiveRecord::findOne(get_class($this), "login = '{$login}'");
    }

    public function loadByLogin($login)
    {
        return $this->loadByCondition("login='" . $login . "'");
    }

    public function loadByEmail($email)
    {
        return $this->loadByCondition("email='" . $email . "'");
    }

    public function getUserHash()
    {
        return md5($this->getEmail() . self::MAGIC_WORD2);
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

}
