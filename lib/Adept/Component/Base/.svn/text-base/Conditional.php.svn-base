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

class Adept_Component_Base_Conditional extends Adept_Component_AbstractBase 
{

    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('cond');
    }
    
    
    /**
     * Evaluate condition
     *
     * @return mxied
     * @throws Adept_Exception_IllegalState
     */
    public function evalCondition()
    {
        $cond = $this->getCond();
        if ($this->isCondValueExpression()) {
            return $cond;
        } 
        if ($cond === null) {
            throw new Adept_Exception_IllegalState('Optional: Condition not defined');
        }
        if (is_string($cond)) {
            // Back compability
            // escape { and }
            $cond = str_replace('{', '\{', $cond);
            $cond = str_replace('}', '\}', $cond);
            $expr = Adept_Expression_Factory::getInstance()->createExpression('{' . $cond . '}');
            return $expr->getValue($this->getExpressionContext());
        } else {
            throw new Adept_Exception_IllegalState("Optional: Invalid 'cond' property value");
        }
    }

    protected function isCondValueExpression()
    {
        return $this->hasValueExpression('cond');
    }
    
    public function getCond() 
    {
        return $this->getProperty('cond');
    }
    
    public function setCond($cond)
    {
        $this->setProperty('cond', $cond);
    }
    
    public function hasRenderer()
    {
        return false;
    }

}