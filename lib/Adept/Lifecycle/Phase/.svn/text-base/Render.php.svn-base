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
 * @package    Adept_Lifecycle
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Lifecycle_Phase_Render extends Adept_Lifecycle_Phase_Abstract 
{    

    public function execute()
    {
        $this->getLogger()->fine('Entering [Render] phase');
        
        if (!$this->getContext()->getResponse()->isComplite()) {
            if ($this->getContext()->getRequest()->isAjax()) {
                $this->renderAjaxResponse();
            } else {
                $this->renderHtmlResponse();
            }
        } else {
            $this->getLogger()->fine('Respone already complite');
        }
        
        $this->getLogger()->fine('Exiting [Render] phase');
    }

    public function getPhaseId()
    {
        return Adept_Lifecycle_PhaseId::RENDER;
    }
    
    protected function renderAjaxResponse()
    {
        $this->getLogger()->info('Rendering AJAX');

        $this->getContext()->getRootView()->renderAjax();
        
        $this->getContext()->getResponse()->sendHeader('Content-type: text/plain; charset=UTF-8');
        Adept_Context::getInstance()->getAjaxChannel()->commit();
    }
    
    protected function renderHtmlResponse()
    {
        $this->getLogger()->info('Rendering HTML');
        
        $root = $this->getContext()->getRootView();
        $root->render();
    }
    
}