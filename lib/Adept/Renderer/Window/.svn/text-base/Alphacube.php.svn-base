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

class Adept_Renderer_Window_Alphacube extends Adept_Renderer_Window_Base
{

    /**
     * @param Adept_Component_Window $component
     */
    public function renderBegin($component)
    {
        if ($component->isDraggable()) {
            $this->renderDragFrame($component);
        }
        
        $writer = $this->getWriter();
        
        $this->renderHeadTable($component);
        $this->renderMiddleTableBegin($component);
    }

    /**
     * @param Adept_Component_Window $component
     */
    protected function renderDragFrame($component)
    {
        $writer = $this->getWriter();
        $writer->writeTag('div', array('id' => "{$component->getClientId()}_drag_frame", 'class' => $component->getRealCssClassName('window-drag-frame')));
    }

    /**
     * @param Adept_Component_Window $component
     */
    protected function renderMiddleTableBegin($component)
    {
        $writer = $this->getWriter();
//        $writer->writeTag('table', array('cellpadding' => 0, 'cellspacing' => 0, 'class' => $component->getRealCssClassName('window-table')));
        $writer->writeTag('tr');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-middle-left')));
        $writer->writeClosedTag('td');
        $writer->writeTag('td', array('style' => 'height: ' . $component->getHeight() . 'px;', 'class' => $component->getRealCssClassName('window-table-middle')));
        $writer->writeTag('div', array('class' => $component->getRealCssClassName('window-content-border')));
        $writer->writeTag('div', array('id' => $component->getDomContainerId(), 'class' => $component->getRealCssClassName('window-content')));
    }

    /**
     * @param Adept_Component_Window $component
     */
    protected function renderMiddleTableEnd($component)
    {
        $writer = $this->getWriter();
        $writer->writeClosedTag('div');
        $writer->writeClosedTag('div');
        $writer->writeClosedTag('td');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-middle-right')));
        $writer->writeClosedTag('td');
        $writer->writeClosedTag('tr');
//        $writer->writeClosedTag('table');
    }

    /**
     * @param Adept_Component_Window $component
     */
    protected function renderHeadTable($component)
    {
        $writer = $this->getWriter();
        $writer->writeTag('div', array('id' => $component->getClientId(), 'class' => $component->getRealCssClassName('window'), 'style' => "height:{$component->getHeight()}px;width:{$component->getWidth()}px;top:{$component->getTop()};left:{$component->getLeft()}"));
        $writer->writeTag('table', array('cellpadding' => 0, 'cellspacing' => 0, 'class' => $component->getRealCssClassName('window-table')));
        $writer->writeTag('tr');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-top-left')));
        $writer->writeClosedTag('td');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-top-middle')));
        $writer->writeClosedTag('td');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-top-right')));
        $writer->writeClosedTag('td');
        $writer->writeClosedTag('tr');
        
        $writer->writeTag('tr');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-middle-left')));
        $writer->writeClosedTag('td');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-middle')));
        $this->renderHead($component);
        $writer->writeClosedTag('td');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-middle-right')));
        $writer->writeClosedTag('td');
        $writer->writeClosedTag('tr');

//        $writer->writeClosedTag('table');
    }

    //    /**
    //     * @param Adept_Component_Window $component
    //     */
    //    protected function renderHead($component)
    //    {
    //        $writer = $this->getWriter();
    //        $writer->writeTag('div', array('class' => $component->getRealCssClassName('window-head'), "id" => $component->getClientId() . '_head'));
    //        $writer->writeTag('div', array('class' => $component->getRealCssClassName('window-icons')));
    //        if ($component->isClosable()){
    //            $writer->writeTag('div', 
    //                array('id' => $component->getClientId() . 'CloseIcon' , 'class' => $component->getRealCssClassName('window-icons-close')));
    //            $writer->writeClosedTag('div');
    //        }
    //        $writer->writeClosedTag('div');
    //        $writer->writeTag('div', array('class' => $component->getRealCssClassName('window-title')) );
    //        $writer->writeHtml($component->getTitle());
    //        $writer->writeClosedTag('div');
    //        $writer->writeClosedTag('div');
    //    }
    //    
    //    
    /**
     * @param Adept_Component_Window $component
     */
    public function renderChildren($component)
    {
        if (!$component->isAjaxLoading()) {
            parent::renderChildren($component);
        } else {
            if ($component->getDirtyState() == Adept_Component_DirtyState::CHILDREN) {
                parent::renderChildren($component);
            } else {
                $this->getWriter()->writeHtml("&nbsp;");
            }
        }
    }

    /**
     * @param Adept_Component_Window $component
     */
    protected function renderBottomTable($component)
    {
        $writer = $this->getWriter();
//        $writer->writeTag('table', array('cellpadding' => 0, 'cellspacing' => 0, 'class' => $component->getRealCssClassName('window-table')));
        $writer->writeTag('tr');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-bottom-left')));
        $writer->writeClosedTag('td');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-bottom-middle')));
        $writer->writeTag('div', array('class' => $component->getRealCssClassName('window-spacer')));
        $writer->writeClosedTag('div');
        $writer->writeClosedTag('td');
        $writer->writeTag('td', array('class' => $component->getRealCssClassName('window-table-bottom-right')));
        $writer->writeClosedTag('td');
        $writer->writeClosedTag('tr');
        $writer->writeClosedTag('table');
    }

    /**
     * @param Adept_Component_Window $component
     */
    public function renderEnd($component)
    {
        $this->renderMiddleTableEnd($component);
        $this->renderBottomTable($component);
        
        $writer = $this->getWriter();
        $writer->writeHtml("<!--[if lte IE 6.5]><iframe class={$component->getRealCssClassName('fucking-ie')} 
            sytle=\"width:{$component->getWidth()}px;height:{$component->getHeight()}px;\"></iframe><![endif]-->");
        $writer->writeClosedTag('div');
        $this->renderWindowController($component);
    }
}

