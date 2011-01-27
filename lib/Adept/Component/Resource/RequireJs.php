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

class Adept_Component_Resource_RequireJs extends Adept_Component_AbstractBase 
    implements Adept_Component_Resource_JsRequired
{

    protected function defineProperties()
    {
    	parent::defineProperties();
    	$this->addPropertyDescription('src', array());
    }
    
    public function getRequiredJs()
    {
        return array($this->getSrc());
    }
    
    public function hasRenderer()
    {
        return false;
    }   
    
    // Properties --------------------------------------------------------------
        public function getSrc()
    {
        return $this->getProperty('src');
    }

    public function setSrc($src)
    {
        $this->setProperty('src', $src);
    }
    
}