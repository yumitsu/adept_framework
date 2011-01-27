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
 * @package    Adept_Renderer
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Renderer_AbstractControl extends Adept_Renderer_Base 
    
{

    /**
     * Render JavaScript that initialize ClientSide controller.
     *
     * @param Adept_Component_AbstractControl $component
     * @param array $constructorParams
     * @param string $id
     */
    public function renderClientController($id, $controllerClass, $constructorParams = array(), $properties = array())
    {
        $writer = $this->getWriter();
        $var = $writer->generateIdentifier();

        $writer->writeHtml("var {$var} = ");

        if ($id !== null) {
            array_unshift($constructorParams, $id);
        }
        
        $writer->writeJsConstructor($controllerClass, $constructorParams, ";\n");
        foreach ($properties as $name => $value) {
            $writer->writeJsMethodCall($var, 'set' . ucfirst($name), array($value), ";\n");
        }
        return $var;
    }
    
    
    
}
