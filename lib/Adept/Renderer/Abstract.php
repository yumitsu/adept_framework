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

abstract class  Adept_Renderer_Abstract 
{

    abstract public function handleRequest($component);
    
    abstract public function renderBegin($component);
    
    abstract public function renderChildren($component);
    
    abstract public function renderEnd($component);
    
    public function render($component) 
    {
        $this->renderBegin($component);
        $this->renderChildren($component);
        $this->renderEnd($component);
    }
    
    public function getConverter()
    {
        return null;
    }
    
    public function getRequiredJs($component)
    {
        return array('Adept/Controller.js', 'Adept/Controller/Tabulator.js');
    }
    
    public function getRequiredCss($component)
    {
        return array();
    }

}
