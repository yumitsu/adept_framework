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
 * @package    Adept_Filter
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

/**
 * Abstract class for application fitlers 
 * 
 * Override method process
 */
class Adept_Filter_Abstract implements Adept_Filter_Interface  
{
    protected $name;

    public function init($config)
    {
        if (isset($config['name'])) {
            $this->setName($config['name']);
        }
    }

    public function process($chain)
    {
        throw new Adept_Exception_AbstractMethod();
    }
    
    /**
     * Return current Adept_Context instance
     * 
     * @return Adept_Context
     */
    public function getContext()
    {
        return Adept_Context::getInstance();        
    }
    
    public function getName() 
    {
        return $this->name;
    }
    
    public function setName($name) 
    {
        $this->name = $name;
    }

}
