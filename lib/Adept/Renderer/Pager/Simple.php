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

class Adept_Renderer_Pager_Simple extends Adept_Renderer_Pager_Base 
{
    
    public function renderLink($innerText, $page = null)
    { 
        if ($page === null) {
            $status = $this->getPagerStatus();
            $page = $status['current'];
        }
        
        $writer = $this->getWriter();
        $writer->writeTag('a', array(
            'href' => '?' . $this->getPager()->getClientId() . '=' . $page 
                . '&amp;event[' . $this->getPager()->getClientId() . ']=' . Adept_Component_Pager::PAGINATE_EVENT,
        ));
        $writer->writeText($innerText);
        $writer->writeClosedTag('a');
    }
    
    public function renderCurrentPage() 
    {
        $status = $this->getPagerStatus();
        $this->getWriter()->writeTag('span');
        $this->getWriter()->writeText($status['current']);
        $this->getWriter()->writeClosedTag('span');
    }
    
    public function renderPage()
    {
        $status = $this->getPagerStatus();
        $this->renderLink($status['current']);
    }
    
    public function renderSkippedSection()
    {
    }
    
    public function renderOnePageOnly()
    {
    }
    
    public function renderPrevious()
    {
    }
    
    public function renderNext()
    {
    }

    public function renderFirst()
    {
        $first = $this->pager->getAttribute('first', new Adept_Verbatim('&lt;&lt;'));
        $this->renderLink($first, 1);
        $this->renderSeparator();
    }
    
    public function renderLast()
    {
        $this->renderSeparator();
        $last = $this->pager->getAttribute('last', new Adept_Verbatim(' &gt;&gt;'));
        $this->renderLink($last);
    }
    
    public function renderSeparator()
    {
        $this->getWriter()->writeHtml($this->separator);
    }

}