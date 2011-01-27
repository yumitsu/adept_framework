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
 * @package    Adept_Config
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

abstract class Adept_Config_Abstract extends Adept_Config
{
    protected $options = array(
        'splitter' => '\.',
        'combinedAttributes' => false,
        'encoding' => null,
    );
    
    public function __construct($name = null, $options = array())
    {
        $this->options = array_merge($this->options, $options);
        
        if ($name != null) {
           $this->load($name);
        }
    }

    /**
     * Load configuration and fill this object.
     *
     * @param string $name File name
     * @return void
     */
    abstract function load($name);
    
    abstract function save($name);

}