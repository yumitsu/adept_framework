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

class Adept_User_Domain extends Adept_Orm_Record 
{
    protected $login;
    protected $password;
    protected $email;
    protected $locale;
    protected $activated;
    
    public static $_classProperties = array(
        'id' => array('column' => 'id'),
        'login' => array('column' => 'login'),
        'password' => array('column' => 'password'),
        'email' => array('column' => 'email'),
        'activated' => array('column' => 'is_activated'),
        'locale' => array('column' => 'locale'),
    );
    
    public function isLoggedIn()
    {
        return  Adept_User_Manager::getInstance()->isLoggedIn();
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }
    
    public function getLocale() 
    {
        return $this->get('locale');
    }
    
    public function setLocale($locale)
    {
        $this->set('locale', $locale);
    }
    
    public function getPassword() 
    {
        return $this->get('password');
    }
    
    public function setPassword($password)
    {
        $this->set('password', $password);
    }
    public function getEmail() 
    {
        return $this->get('email');
    }
    
    public function setEmail($email)
    {
        $this->set('email', $email);
    }
    
    public function isActivated() 
    {
        return $this->get('activated');
    }
    
    public function setActivated($activated)
    {
        $this->set('activated', $activated);
    }
    
}