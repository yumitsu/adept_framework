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

class Adept_Component_Pager_Properties 
{

    protected $current;

    /**
     * @var Adept_Component_Pager
     */
    protected $pager;
    
    public function __construct($pager)
    {
        $this->pager = $pager;
    }

    /**
     * Current page number.
     *
     * @return int
     */
    public function getCurrent() 
    {
        return $this->current;
    }
    
    public function setCurrent($current) 
    {
        $this->current = $current;
    }
    
    // Helpers ----------------------------------------------------------------
    
    protected function getPageUrl($page)
    {
        return "?{$this->pager->getClientId()}={$page}";
    }
    
    protected function getPageSection($page)
    {
        return ceil($page / $this->pager->getPagesPerSection());
    }
    
    // Properties -------------------------------------------------------------
    
    public function getTotalPages()
    {
        return $this->pager->getTotalPages();
    }
    
    public function getTotalItems()
    {
        return $this->pager->getTotalItems();
    }
    
    public function getUrl()
    {
        if ($this->isCurrentSection()) {
            return $this->getPageUrl($this->current);
        } else {
            return $this->getSectionUrl();
        }
    }
    
    public function isFirst()
    {
        return $this->current == 1;
    }
    
    public function isLast()
    {
        return $this->pager->getTotalPages() == $this->current;
    }

    public function getSection()
    {
        return $this->getPageSection($this->current);
    }
    
    public function isCurrentPage()
    {
        return $this->current == $this->pager->getCurrentPage();
    }
    
    public function isCurrentSection()
    {
        return $this->getPageSection($this->current) == $this->getPageSection($this->pager->getCurrentPage());
    }
    
    public function getSectionBeginPage($page = null)
    {
        if ($page === null) {
            $page = $this->current;
        }
        
        $section = $this->getPageSection($page);
        
        $result = ($section - 1) * $this->pager->getPagesPerSection() + 1;
        return  ($result < 1) ? 1 : $result;
    }

    public function getSectionEndPage($page = null)
    {
        if ($page === null) {
            $page = $this->current;
        }
        
        $section = $this->getPageSection($page);
        
        $result = $section * $this->pager->getPagesPerSection();
        $total = $this->pager->getTotalPages();
        return ($result > $total) ? $total : $result;
    }
    
    public function getSectionUrl()
    {
        if ($this->current > $this->pager->getCurrentPage()) {
            return $this->getPageUrl($this->getSectionBeginPage($this->current));    
        } else {
            return $this->getPageUrl($this->getSectionEndPage($this->current));
        }
    }
    
}
