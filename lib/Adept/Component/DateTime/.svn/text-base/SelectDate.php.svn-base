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

class Adept_Component_DateTime_SelectDate extends Adept_Component_AbstractInput 
{

    protected $readOnly = null;
    
    public function hasRenderer() 
    {
        return true;
    }    
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_DateTime_SelectDate';
    }        
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('readOnly', array(self::CAP_PERSISTENT), false);
        $this->addPropertyDescription('minYear', array(self::CAP_PERSISTENT), 1920, self::TYPE_INT);
        $this->addPropertyDescription('maxYear', array(self::CAP_PERSISTENT), 2020, self::TYPE_INT);
    }
    
    protected function equalValues($first, $second)
    {
        if (!$first instanceof Adept_Date || !$second instanceof Adept_Date) {
            return false;
        }
        return $first->compareDate($second) === 0;
    }
    
    public function defineBrowserEvents()
    {
        return array();
    }
    
    public function isReadOnly() 
    {
        return $this->getProperty('readOnly');
    }
    
    public function setReadOnly($readOnly)
    {
        $this->setProperty('readOnly', $readOnly);
    }
    
    public function getMinYear() 
    {
        return $this->getProperty('minYear', 1920);
    }
    
    public function setMinYear($minYear)
    {
        $this->setProperty('minYear', $minYear);
    }
    
    public function getMaxYear() 
    {
        return $this->getProperty('maxYear', 2020);
    }
    
    public function setMaxYear($maxYear)
    {
        $this->setProperty('maxYear', $maxYear);
    }
    
}
