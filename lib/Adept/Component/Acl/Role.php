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
 * @package    Adept_Component
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Component_Acl_Role extends Adept_Component_Acl_CheckAcl 
{

    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('role');
    }
    
    protected function getRoles()
    {
        $result = array();
        foreach (explode(',', $this->getRole()) as $role) {
            $result[] = strtolower(trim($role));
        }
        return $result;
    }
    
    public function checkAcl()
    {
        $role = $this->getUser()->getRoleId();
        return in_array(strtolower($role), $this->getRoles());        
    }
    
    public function getRole() 
    {
        return $this->getProperty('role');
    }
    
    public function setRole($role) 
    {
        $this->setProperty('role', $role);
    }
    
}

