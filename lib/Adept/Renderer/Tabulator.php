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

class Adept_Renderer_Tabulator extends Adept_Renderer_AbstractControl
{
    
    /**
     * @param Adept_Component_Tabulator $component
     */
    public function handleRequest($component)
    {
        $request = $this->getRequest();
        if ($component->isPersistent()) {
            $cookieName = $component->getCookieId() . "_selected";
            if ($request->hasCookie($cookieName)) {
                $component->setSelected($request->getCookie($cookieName));
            }
            
        }
    }

    /**
     * @param Adept_Component_Tabulator $component
     */
    public function renderHead($component)
    {
        $writer = $this->getWriter();
        $writer->writeTag('div', array(
            'class' => "{$component->getCssPrefix()}-tabulator",
            'style' =>  "width:{$component->getWidth()}; height:{$component->getHeight()}; " . $component->getCssStyle() ,
            'id' => $component->getClientId()
        ));
    }
    
    /**
     * @param Adept_Component_Tabulator $component
     * @param Adept_Component_TabItem $tabItem
     */
    public function renderSelector($component, $tabItem)
    {
        $writer = $this->getWriter();
        
        $writer->writeTag('div', array('class' => $component->getCssPrefix() . '-tabselector-text'));
        $writer->writeTag('span');
        $writer->writeText($tabItem->getTitle());
        $writer->writeClosedHtmlTag('span');
        $writer->writeClosedTag('div');
    }
    
    /**
     * @param Adept_Component_Tabulator $component
     */
    public function renderSelectors($component)
    {
        $writer = $this->getWriter();
        
         $spaceTabFacet = $component->getFacet(Adept_Component_Tabulator::SPACETAB_FACET);
        
        $writer->writeHtmlTag('table', array(
            'cellpadding' => 0,
            'cellspacing' => 0,
            'border' => 0,
            'class' => ($component->getCssClass() !== null) ? $component->getCssClass() : "{$component->getCssPrefix()}-tabselectors",
        ));
        
        $writer->writeTag('tr');
        
        $separatorFacet = $component->getFacet(Adept_Component_Tabulator::SEPARATOR_FACET);

        $first = true;
        foreach ($component->getTabItems() as $tabItem) {
            if (!$tabItem->isRendered()) {
                continue;
            }
            $tdClass = "{$component->getCssPrefix()}-tabselector";
            if ($first) {
                $tdClass .= " {$component->getCssPrefix()}-tabselector-first";
                $first = false;
            }
            else {
                // Separator facet
                if ($separatorFacet != null) {
                    $writer->writeTag('td');
                    $separatorFacet->render();
                    $writer->writeTag('/td');
                }
            }
            $writer->writeHtmlTag('td', array(
                'class' => $tdClass,
                'id' => $tabItem->getClientId() . '_selector',
            ));
            $this->renderSelector($component, $tabItem);
            $writer->writeTag('/td');
        }
        
        $writer->writeTag('td', array('class' => $component->getCssPrefix() . '-tabspace', 'width' => '100%'));
        if ($spaceTabFacet !== null) {
        }
        $writer->writeHtml('&nbsp;');
        $writer->writeTag('/td');
        $writer->writeTag('/tr');
        $writer->writeTag('/table');
    }
    
    /**
     * @param Adept_Component_Tabulator $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        
        $spaceTabFacet = $component->getFacet(Adept_Component_Tabulator::SPACETAB_FACET);

        // SpaceTab facet
        $this->renderHead($component);
//        if ($spaceTabFacet != null) {
//            $writer->writeHtml('<table width="100%"><tr><td>');
//        }
        
        $this->renderSelectors($component);
        
        // SpaceTab facet
//        if ($spaceTabFacet != null) {
//            $writer->writeHtml('</td><td>');
//            $spaceTabFacet->render();
//            $writer->writeHtml('</td></tr></table>');
//        }
     }
    
    /**
     * @param Adept_Component_Tabulator $component
     */
    public function renderChildren($component)
    {   
        $children = $component->findChildrenByClass('Adept_Component_TabItem', false);
        foreach ($children as $child) {    
            $child->render($child);
        }
    }
    
    /**
     * @param Adept_Component_Tabulator $component
     */
    public function renderController($component)
    {
        $writer = $this->getWriter();
        
        $writer->writeScriptBegin();
        
        $controlerName = $this->renderClientController($component->getClientId(), 
            'Adept.Controller.Tabulator', array($component->getCssPrefix()));
        
        $selected = 0;
        $itemIndex = 0;
        foreach ($component->getTabItems() as $item) {
            if (!$item->isRendered()) {
                continue;
            }
            $writer->writeJsMethodCall($controlerName, 'addItem', 
                array($item->getClientId(), !$item->isAjaxLoading(), $item->isForceUpdate()));
            if ($item->isSelected()) {
                $selected = $itemIndex;
            }
            $itemIndex++;
        }
        $writer->writeJsMethodCall($controlerName, 'activate', array($selected), ";\n");
        $writer->writeScriptEnd(); 
    }
    
    
    /**
     * @param Adept_Component_Tabulator $component
     */
    public function renderEnd($component)
    {
        $this->getWriter()->writeClosedTag('div');
        $this->renderController($component);
    }

    public function getRequiredCss($component)
    {
        if ($component->getCssPrefix() == 'a') {
            return array('Adept/tabulator.css');
        }
        return array();
    }
    
    public function getRequiredJs($component)
    {
        return array('Adept/Controller.js', 'Adept/Controller/Tabulator.js', 'Adept/Controller/TabItem.js');
    }

}

