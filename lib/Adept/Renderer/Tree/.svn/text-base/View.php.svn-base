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

class Adept_Renderer_Tree_View extends Adept_Renderer_Composite  
{  
    
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        $writer->writeTag('ul', array(
            'class' => $this->getRealCssClass($component, 'tree-view')
        ));
    }
    
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeClosedTag('ul');
    }
    
}
