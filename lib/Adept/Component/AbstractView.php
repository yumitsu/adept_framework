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

abstract class Adept_Component_AbstractView extends Adept_Component_AbstractPersistent 
{ 
    
    /**
     * Parent view
     *
     * @var Adept_Component_View_AbstractView
     */
    protected $parentView; 
    
    /**
     * @var Adept_List
     */
    protected $eventsQueue;
    
    public function __construct()
    {
        parent::__construct();
        $this->expressionContext = new Adept_Expression_Context();
    }

    // ------------------------------------------------------------------------   
    
    /**
     * @return Adept_Component_AbstractView
     */
    public function getView()
    {
        return $this;
    }
    
    public function hasRenderer()
    {
        return false;
    }    
    

    
    // Properties ------------------------------------------------------------------------
    
    /**
     * Returns expression context for this view.
     *
     * @var Adept_Expression_Context
     */
    public function getExpressionContext() 
    {
        if (null == $this->expressionContext) {
            $this->setExpressionContext(new Adept_Expression_Context());
        }
        return $this->expressionContext;
    }
    
    public function setExpressionContext($expressionContext) 
    {
        $this->expressionContext = $expressionContext;
    }
    
    public function getParentView() 
    {
        return $this->parentView;
    }
    
    public function setParentView($parentView) 
    {
        $this->parentView = $parentView;
    }

}