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

class Adept_Component_SetIfEmpty extends Adept_Component_Set 
{
    
    public function doSet() 
    {
        if ($this->isGlobal()) {
            $context = Adept_Context::getInstance();
        } else {
            $context = $this->getExpressionContext();
        }
        
        $binding = $this->getValueBinding('binding');
        if ($binding) {
            // Binding variable
            $currentValue = $binding->getValue($context);
            if ($currentValue === null || $currentValue === '') {    
                $binding->setValue($context, $this->getValue());
            }
        } else {
            // Single variable
            $currentValue = $context->get($this->getName());
            if ($currentValue === null || $currentValue === '') {
                $context->set($this->getName(), $this->getValue());
            }
        }
    }    
    
}
