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

abstract class Adept_Component_Acl_CheckAcl extends Adept_Component_Base_StrictConditional
{
    
    abstract public function checkAcl();
    
    public function isProcessPhase($phaseId)
    {
        return $this->checkAcl();
    }
    
    /**
     * @return Adept_UserAcl
     */
    public function getAcl()
    {
        return $this->getContext()->getAcl();
    }

    /**
     * @return Adept_User_IUser
     */
    public function getUser()
    {
        return $this->getContext()->getUser();
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
    
}

