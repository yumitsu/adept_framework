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

class Adept_Component_Transform_If extends Adept_Component_AbstractBase 
{

    public function init()
    {
        $cond = $this->getCond();
        
        $result = array();
        $inElseBlock = false;
        
        /*
         * Filter children depend on condition
         */
        foreach ($this->getChildren() as $child) {
            if ($child instanceof Adept_Component_Transform_Else) {
                if ($inElseBlock) {
                    throw new Adept_Component_Exception('Dublicated Else components');
                }
                $inElseBlock = true;
            } else {
                if (($cond && !$inElseBlock) || (!cond && $inElseBlock)) {
                    $result[] = $child;
                }
            }
        }
        
        /*
         * Update children list.
         */         
        $this->getChildren()->removeAll();
        $this->getChildren()->merge($result);
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
    public function getCond() 
    {
        return $this->getProperty('cond');
    }
    
    public function setCond($cond) 
    {
        $this->setProperty('cond', $cond);
    }
    
}