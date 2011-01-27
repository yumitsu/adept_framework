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

class Adept_Renderer_Grid_Column extends Adept_Renderer_Base 
{

    /**
     * @param Adept_Component_Grid_Column $component
     */
    public function renderTitle($component)
    {
        $writer = $this->getWriter();

        $writer->writeTag('th', array(
            'class' => $component->getTitleClass(),
            'style' => $component->getTitleStyle(),
        ));
        
        if (($facet = $component->getFacet('title')) !== null) {
            $facet->render();
        } else {
            $writer->writeText($component->getTitle());
        }
        
        $writer->writeClosedTag('th');
    }
    
    /**
     * @param Adept_Component_Grid_Column $component
     */
    public function renderBegin($component)
    {
        $this->getWriter()->writeTag('td', array(
            'class' => $component->getCssClass(),
            'style' => $component->getCssStyle(),
        ));
    }

    /**
     * @param Adept_Component_Grid_Column $component
     */
    public function renderEnd($component)
    {
        $this->getWriter()->writeClosedTag('td');
    }

}
