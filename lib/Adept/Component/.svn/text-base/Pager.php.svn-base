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

class Adept_Component_Pager extends Adept_Component_AbstractControl 
{
    
    const PAGINATE_EVENT = 'paginate';
    
    protected $status;
    
    public function hasRenderer()
    {
        return true;
    }
    
    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Pager_Simple';
    } 
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('currentPage', array(self::CAP_PERSISTENT), 1, self::TYPE_INT);
        $this->addPropertyDescription('itemsPerPage', array(), 10, self::TYPE_INT);
        $this->addPropertyDescription('paginated', array(self::CAP_CLIENT), false);
        $this->addPropertyDescription('totalItems', array());
        $this->addPropertyDescription('ajaxLoading', array(), false, self::TYPE_BOOL);
    }
    
    public function invokeApplication()
    {
        $currentPage = $this->getCurrentPage();

        if($this->isPaginated()){
        $this->queueEvent(new Adept_Event_Paginate($this, $currentPage, $this->getItemsPerPage(), 
            $this->getItemsPerPage() * ($currentPage - 1)));
        }
    }
    
    public function getCurrentOffset()
    {
    	return ($this->getCurrentPage() - 1) * $this->getItemsPerPage() > 0 ? ($this->getCurrentPage() - 1) * $this->getItemsPerPage() : 0;
    }
    
    public function defineBrowserEvents()
    {
        return array();
    }
    
    protected function calculateCurrentStatus($currentPage)
    {
        return array(
            'current' => $currentPage,
            'first' => (1 == $currentPage), 
            'last' => ($this->getTotalPages() == $currentPage)
        );
    }
    
    public function updateStatus($currentPage)
    {
        $this->status = $this->calculateCurrentStatus($currentPage);
        if ($this->getVarStatus() !== null && $this->status != null) {
            $this->getExpressionContext()->set($this->getVarStatus(), $this->status);
        }
    }
    
    public function getItemsPerPage() 
    {
        return $this->getProperty('itemsPerPage');
    }
    
    public function setItemsPerPage($itemsPerPage)
    {
        $this->setProperty('itemsPerPage', $itemsPerPage);
    }
    
    public function getTotalItems() 
    {
        return $this->getProperty('totalItems');
    }
    
    public function setTotalItems($totalItems)
    {
        $this->setProperty('totalItems', $totalItems);
    }
    
    public function getTotalPages()
    {
        return $this->getItemsPerPage() == 0 ? 1 : ceil($this->getTotalItems() / $this->getItemsPerPage());
    }
    
    public function getCurrentPage()
    {
        $value = $this->getProperty('currentPage');
        if ($value > $this->getTotalPages()) {
            return $this->getTotalPages(); 
        } 
        return $value;
    }
    
    public function setCurrentPage($currentPage)
    {
        if ($currentPage < 1) {
            $this->setProperty('currentPage', 1);
        } else {
            $this->setProperty('currentPage', $currentPage);
        }
    }
    
    public function getVarStatus() 
    {
        return $this->getProperty('varStatus');
    }
    
    public function setVarStatus($varStatus)
    {
        $this->setProperty('varStatus', $varStatus);
    }
    
    public function getStatus() 
    {
        return $this->status;
    }
    
    public function isAjaxLoading() 
    {
        return $this->getProperty('ajaxLoading');
    }
    
    public function setAjaxLoading($ajaxLoading)
    {
        $this->setProperty('ajaxLoading', $ajaxLoading);
    }
    
    public function isPaginated() 
    {
        return $this->getProperty('paginated');
    }
    
    public function setPaginated($paginated) 
    {
        $this->setProperty('paginated', $paginated);
    }
    
}
