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

class Adept_Component_MapMarker extends Adept_Component_Base 
{
    
    protected $description;
    protected $latitude;
    protected $longitude;
    protected $type;

    public function getDescription() 
    {
        if (!is_null($this->description)) {
            return $this->description;
        }
        return $this->getValueOfBinding('description', '');
    }
    
    public function setDescription($description) 
    {
        $this->description = $description;
    }
    
    public function getLatitude() 
    {
        if (!is_null($this->latitude)) {
            return $this->latitude;
        }
        return $this->getValueOfBinding('latitude', 0);
    }
    
    public function setLatitude($latitude) 
    {
        $this->latitude = $latitude;
    }

    public function getLongitude() 
    {
        if (!is_null($this->longitude)) {
            return $this->longitude;
        }
        return $this->getValueOfBinding('longitude', 0);
    }
    
    public function setLongitude($longitude) 
    {
        $this->longitude = $longitude;
    }
    
    public function getType() 
    {
        if (!is_null($this->type)) {
            return $this->type;
        }
        return $this->getValueOfBinding('type', Adept_Model_MapMarker::TYPE_RED_MARKER);
    }
    
    public function setType($type) 
    {
        $this->type = $type;
    }
}