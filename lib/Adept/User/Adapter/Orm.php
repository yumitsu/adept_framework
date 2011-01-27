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

class Adept_User_Adapter_Orm implements Adept_User_Adapter_Interface 
{

    protected $ormSession;
    protected $userClassName;

    public function __construct($ormSession, $userClassName)
    {
        $this->ormSession = $ormSession;
        $this->userClassName = $userClassName;
    }
    
    public function findUserByLogin($login)
    {
        $user = $this->getOrmSession()->findOne($this->userClassName, 
            array(
                new Adept_Db_Criteria_Field('login', ':login:')),
            array(
                'login' => $login));
        return $user;                
    }

    public function findUserByLoginAndPassword($login, $password)
    {
        $user = $this->getOrmSession()->findOne($this->userClassName, 
            array(
                new Adept_Db_Criteria_Field('login', ':login:'),
                new Adept_Db_Criteria_Field('password', ':password:')),
            array(
                'login' => $login,
                'password' => $password));
        return $user;                
    }
    
    public function createAnonymousUser()
    {
        $user = new $this->userClassName();
        return $user;
    }
    
    public function findUserById($id)
    {
        return $this->getOrmSession()->tryLoad($this->userClassName, $id);
    }
    
    /**
     * @return Adept_Orm_Session
     */
    public function getOrmSession()
    {
        return $this->ormSession;
    }
    
}
