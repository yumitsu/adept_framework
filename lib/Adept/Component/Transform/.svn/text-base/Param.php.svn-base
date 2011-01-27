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

class Adept_Component_Transform_Param extends Adept_Component_AbstractBase 
{

    // Properties --------------------------------------------------------------
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('name');
        $this->addPropertyDescription('value');
    }
    
    // PhaseListener -----------------------------------------------------------
    
    public function processHandleRequest()
    {
        $this->doSet();
        parent::processHandleRequest();
    }
    
    public function processValidation()
    {
        $this->doSet();
        parent::processValidation();
    }
    
    public function processUpdateModel()
    {
        $this->doSet();
        parent::processUpdateModel();            
    }
    
    public function processInvokeApplication()
    {
        $this->doSet();
        parent::processInvokeApplication();
    }
    
    public function renderChildren()
    {
        
        $this->doSet();
        parent::renderChildren();
    }
    
    public function renderAjax()
    {
        $this->doSet();
        parent::renderAjax(); 
    }    
    
    public function doSet()
    {
    	$this->getExpressionContext()->set($this->getName(), $this->getValue());
    }

    /**
     * @return Adept_Expression_Context
     */
    protected function getParentExpressionContext()
    {
        return $this->getView()->getParent()->getExpressionContext();
    }
    
    public function getName() 
    {
        return $this->getProperty('name');
    }
    
    public function setName($name) 
    {
        $this->setProperty('name', $name);
    }
    
    public function setValue($value)
    {
        $this->setProperty('value', $value);
    }
    
    public function getValue()
    {
        $value = $this->getLocalProperty('value');
        if ($value === null) {
            $binding = $this->getValueExpression('value');
            if ($binding !== null) {
                // Calculate property in parent context.
                $value = $binding->getValue($this->getParentExpressionContext());        
            }
        }
        return $value;
    } 
    
    public function hasRenderer()
    {
        return false;
    }
    
}