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

class Adept_Component_Base_TextInput extends Adept_Component_AbstractInput 
    implements Adept_Component_Focusable, Adept_Component_Validatable 
{

    public function defineBrowserEvents()
    {
        return array();
    }
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('accesskey', array(self::CAP_PERSISTENT), null);
        $this->addPropertyDescription('tabIndex', array(self::CAP_PERSISTENT), null);
    }
    
    // Focusable --------------------------------------------------------------
    
    public function getAccessKey() 
    {
        return $this->getProperty('accesskey');
    }
    
    public function setAccessKey($accesskey)
    {
        $this->setProperty('accesskey', $accesskey);
    }
    
    public function getTabIndex() 
    {
        return $this->getProperty('tabIndex');
    }
    
    public function setTabIndex($tabIndex)
    {
        $this->setProperty('tabIndex', $tabIndex);
    }    

}
