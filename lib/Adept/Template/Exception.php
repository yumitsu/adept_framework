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
 * @package    Adept_Template
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Template_Exception extends Adept_Exception 
{
    /**
     * @var Adept_Template_Location
     */
    protected $location;
    
    public function __construct($message, $params = array(), $location = null)
    {
        $this->location = $location;
        if ($location != null) {
            $params['Template File'] = $location->getFileName();
            $params['Template Line'] = $location->getLineNumber();
        } else {
            $params['Template File'] = 'Unknown file';
            $params['Template Line'] = 'Unknown line';
        }
        parent::__construct($message, 0, $params);        
    }
    
    /**
     * @return Adept_Template_Location
     */
    public function getLocation() 
    {
        return $this->location;
    }
    
    public function toString()
    {
        if (php_sapi_name() != 'cli') {
            $renderer = new Adept_Exception_Renderer_Template_Html();
        } else {
            $renderer = new Adept_Exception_Renderer_Text();
        }
        return $renderer->render($this);        
    }
    
}