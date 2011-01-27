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

class Adept_Renderer_Base_Button extends Adept_Renderer_AbstractCommand
{

    /**
     * @param Adept_Component_Base_Button $component
     */
    public function handleRequest($component)
    {
        $request = $this->getContext()->getRequest();
        
        $component->setClicked(false);
        
        if ($request->isAjax()) { 
            if (($event = $request->get('event')) != null) {
                if (isset($event[$component->getClientId()]) 
                    && $event[$component->getClientId()] == Adept_Component_Base_Button::CLICK_EVENT) {
                    $component->setClicked(true);
                }
            }
        } else {
            if ($request->has($component->getClientId())) {
                $component->setClicked(true);
            }
        }
    }

}
