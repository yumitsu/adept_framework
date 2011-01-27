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

class Adept_Component_Acl_Allow extends Adept_Component_Acl_CheckAcl 
{
    
    protected function defineProperties()
    {
        parent::defineProperties();
        
        $this->addPropertyDescription('privilege');
        $this->addPropertyDescription('resource');
        $this->addPropertyDescription('role');
    }    

    public function checkAcl()
    {
        $role = $this->getRole();
        
        // Get curernt user role by default
        
        if ($role === null) {
        	if($this->getUser() instanceof Adept_Acl_Role_Interface){
                $role = $this->getUser();
        	}
        }
        return $this->getAcl()->isUserAllowed($role, $this->getResource(), $this->getPrivilege());
    }
    
    public function getPrivilege() 
    {
        return $this->getProperty('privilege');
    }
    
    public function setPrivilege($privilege) 
    {
        $this->setProperty('privilege', $privilege);
    }
    
    public function getResource() 
    {
        return $this->getProperty('resource');
    }
    
    public function setResource($resource) 
    {
        $this->setProperty('resource', $resource);
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

