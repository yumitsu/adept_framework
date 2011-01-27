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

class Adept_Renderer_Grid_View extends Adept_Renderer_Base implements Adept_Component_Cycle_CycleObserver  
{

    /**
     * @var Adept_Component_Grid_View
     */
    protected $gridView;

    // Observer ----------------------------------------------------------------
    
    /**
     * @param Iterator $iterator
     */
    public function beforeIterateChildren($iterator)
    {
        $this->gridView->updateKeyAndValue($iterator->key(), $iterator->current());
        $this->getWriter()->writeTag('tr');
    }

    /**
     * @param Iterator $iterator
     * @param Adept_Component_AbstractComponent $child
     * @param int $iteration
     */
    public function iterateChild($iterator, $child, $iteration)
    {
        $this->gridView->getListProperties()->setIndex($iteration);
        Adept_Lifecycle_PhaseInvoker::processPhase($child, Adept_Lifecycle_PhaseId::RENDER);
    }
    
    /**
     * @param Iterator $iterator
     */
    public function afterIterateChildren($iterator)
    {
        $this->getWriter()->writeClosedTag('tr');
    }
    
    public function nothingToIterate($iterator)
    {
        $default = $this->gridView->getFacet(Adept_Component_Grid_View::DEFAULT_FACET);
        if ($default) {
            Adept_Lifecycle_PhaseInvoker::processPhase($default, Adept_Lifecycle_PhaseId::RENDER);
        }
    }    

    // Rendering methods ------------------------------------------------------

    /**
     * @param Adept_Component_Grid_View $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        
        $writer->writeTag('table', array(
            'class' => $component->getCssClass(),
            'style'  => $component->getCssStyle(),
            'id' => $component->getClientId(),
        ));
        
        $writer->writeTag('thead');
        $writer->writeTag('tr');
        
        foreach ($component->getChildren() as $column) {  
            if ($column instanceof Adept_Component_Grid_Column && $column->isRendered()) {
                $column->renderTitle();
            }
        }
        
        $writer->writeClosedTag('tr');
        $writer->writeClosedTag('thead');
        
        $writer->writeTag('tbody');
    }
    
    /**
     * @param Adept_Component_Grid_View $component
     */
    public function renderChildren($component)
    {
        $this->gridView = $component;
        $component->iterateChildren($this);
    }
    
    /**
     * @param Adept_Component_Grid_View $component
     */
    public function renderEnd($component)
    {
        $writer = $this->getWriter();
        
        $writer->writeClosedTag('tbody');
        $writer->writeClosedTag('table');
    }

}