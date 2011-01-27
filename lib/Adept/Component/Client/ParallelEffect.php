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

class Adept_Component_Client_ParallelEffect extends Adept_Component_AbstractBase 
{
    
    public function hasRenderer()
    {
        return false;
    }
    
    // Properties---------------------------------------------------------------
    
    public function renderBegin()
    {
        $writer = $this->getResponseWriter();
        $writer->writeHtml("new Adept.Effect.Parallel()");
    }
    
    public function renderChildren()
    {
        $writer = $this->getResponseWriter();
        $effects = $this->findChildrenByClass("Adept_Component_Client_Effect", false);
        foreach ($effects as $effect){
            $writer->writeHtml(".add(");
            $effect->render();
            
            $writer->writeHtml(")");
        }
        
    } 
    
    public function renderEnd()
    {
        $writer = $this->getResponseWriter();
         foreach ($this->getAttributes() as $name => $value){
            $writer->writeHtml(".{$name}('{$value}')");
        }
        $writer->writeHtml(".go();");
         
    }
    
    public function getRequiredJs()
    {
        
       return array(
          "Adept/Effect/Base.js",
          "Adept/Effect/Factory.js",
          "Adept/Effect/Parallel.js"
       );
    }
    
}