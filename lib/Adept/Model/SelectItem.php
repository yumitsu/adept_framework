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
 * @package    Adept_Model
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Model_SelectItem
{

    protected $disabled = false;
    protected $description = null;
    protected $title = null;
    protected $value = null;
    protected $clientId = null;

    public function __construct($value, $title = null, $description = null, $disabled = false, $clientId = null)
    {
        $this->title = ($title != null) ? $title : $value;
        $this->value = $value;
        $this->description = $description;
        $this->disabled = $disabled;
    }

    public function getDisabled()
    {
        return $this->disabled;
    }

    public function isDisabled()
    {
        $dis = ($this->getDisabled()) ? true : false;
        return $dis;
    }

    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function getClientId() 
    {
        return $this->clientId;
    }
    
    public function setClientId($clientId) 
    {
        $this->clientId = $clientId;
    }

}