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

abstract class Adept_Renderer_Pager_Base extends Adept_Renderer_AbstractControl 
{
    
    protected $clientController = 'Adept.Controller.Pager';
    
    /**
     * @var Adept_Component_Pager
     */
    protected $pager;
    
    /**
     * Current rendering page index
     * @var int
     */
    protected $current;
    
    protected $separator = ' ';
    protected $skipped = '...';
    
    // Base rendering methods ---------------------------------------------
    
    public function renderCurrentPage()
    {
    }
    
    public function renderPage()
    {
    }
    
    public function renderSection()
    {
    }
    
    public function renderSkipped()
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
    }
    
    public function renderLast()
    {
    }
    
    public function renderSeparator()
    {
    }
    
    // Helpers ----------------------------------------------------------------
    
    
    // Base renderers methods -------------------------------------------------
    
    /**
     * @param Adept_Component_Pager $component
     */
    public function handleRequest($component)
    {
        $request = $this->getContext()->getRequest();
        
        if (($event = $request->get('event')) != null) {
            if (isset($event[$component->getClientId()])
                && $event[$component->getClientId()] == Adept_Component_Pager::PAGINATE_EVENT) {
                $page = $request->get($component->getClientId());
                
                $component->setCurrentPage($page);
                $component->setPaginated(true);
            }
        }
    }

    /**
     * @param Adept_Component_Pager $component
     */
    public function renderBegin($component)
    {
        $this->getWriter()->writeTag('div', array(
            'id' => $component->getClientId(),
            'class' => $component->getCssClass(), 
            'style' => $component->getCssStyle()
        ));
    }
    
    /**
     * @param Adept_Component_Pager $component
     */
    public function renderChildren($component)
    {
        $this->pager = $component;
        
        if ($component->getTotalPages() <= 1) {
            $this->renderOnePageOnly();
            return ;
        }
        
        if ($component->getCurrentPage() != 1) {
            $this->renderFirst();
        }

        $fromPage = 1;
        $toPage = $component->getTotalPages();
        $delta = 1;
        
        for($page = $fromPage; $page <= $toPage; $page += $delta) {
            $this->getPager()->updateStatus($page);
            
            if ($page == $component->getCurrentPage()) {
                $this->renderCurrentPage();
            } else {
                $this->renderPage();
            }
            if ($page != $toPage) {
                $this->renderSeparator();
            }
        }
        
        if ($component->getCurrentPage() != $component->getTotalPages()) {
            $this->renderLast();
        }    
    }
    
    public function renderEnd($component)
    {
        $this->getWriter()->writeClosedTag('div');
        
        if ($component->isAjaxLoading() != false){
	        $this->getWriter()->writeScriptBegin();            
    	    $clientId = $component->getClientId();
            $properties = array(
                'ajaxLoading' => $component->isAjaxLoading(),
            );
        
            $this->renderClientController($clientId, $this->getClientController(), array(), $properties);
            $this->getWriter()->writeScriptEnd();
		}
    }

    /**
     * @var Adept_Component_Pager
     */
    public function getPager() 
    {
        return $this->pager;
    }
    
    public function setPager($pager) 
    {
        $this->pager = $pager;
    }

    public function getPagerStatus()
    {
        return $this->getPager()->getStatus();
    }
    

    public function getClientController()
    {
        return $this->clientController;
    }
    
    /**
     * @param Adept_Component_Pager $component
     * @return array
     */
    public function getRequiredJs($component)
    {
        if ($component->isAjaxLoading() != false){
            return array('Adept/Controller.js', 'Adept/Controller/Pager.js');
        }
        return array();
    }
}