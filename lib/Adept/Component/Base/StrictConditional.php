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

abstract class Adept_Component_Base_StrictConditional extends Adept_Component_AbstractBase 
{
    
    abstract public function isProcessPhase($phaseId);
    
    // Phase handlers ---------------------------------------------------------

    public function processHandleRequest()
    {
        if ($this->isProcessPhase(Adept_Lifecycle_PhaseId::HANDLE_REQUEST)) {
            parent::processHandleRequest();     
        }
    }
    
    public function processValidation()
    {
        if ($this->isProcessPhase(Adept_Lifecycle_PhaseId::VALIDATION)) {
            parent::processValidation();
        }
    }
    
    public function processUpdateModel()
    {
        if ($this->isProcessPhase(Adept_Lifecycle_PhaseId::UPDATE_MODEL)) {
            parent::processUpdateModel();            
        }
    }
    
    public function processInvokeApplication()    
    {
        if ($this->isProcessPhase(Adept_Lifecycle_PhaseId::INVOKE_APPLICATION)) {
            parent::processInvokeApplication();
        }
    }
    
    public function renderChildren()
    {
        if ($this->isProcessPhase(Adept_Lifecycle_PhaseId::RENDER)) {
            parent::renderChildren();
        }
    }
    
    public function renderAjax()
    {
        if ($this->isProcessPhase(Adept_Lifecycle_PhaseId::RENDER_AJAX)) {
            parent::renderAjax(); 
        }
    }
    
}