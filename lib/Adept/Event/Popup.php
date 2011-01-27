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
 * @package    Adept_Event
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Event_Popup extends Adept_Event_Abstract 
{
    protected $scope;
    
    public function __construct($sender, $scope = null)
    {
        parent::__construct('popup', $sender);
        $this->scope = $scope;
    }
    
    public function getScope() 
    {
        return $this->scope;
    }
    
    public function setScope($scope) 
    {
        $this->scope = $scope;
    }  
    
}