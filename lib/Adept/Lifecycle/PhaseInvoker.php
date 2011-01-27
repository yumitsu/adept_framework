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

class Adept_Lifecycle_PhaseInvoker 
{

    public static function processPhase($component, $phaseId)
    {   
        switch ($phaseId) {
            case Adept_Lifecycle_PhaseId::INIT:
                $component->processInit();
                break;
            case Adept_Lifecycle_PhaseId::RESTORE_STATE:
                $component->processRestoreState();
                break;
            case Adept_Lifecycle_PhaseId::HANDLE_REQUEST:
                $component->processHandleRequest();
                break;
            case Adept_Lifecycle_PhaseId::VALIDATION :
                $component->processValidation();
                break;
            case Adept_Lifecycle_PhaseId::UPDATE_MODEL:
                $component->processUpdateModel();
                break;
            case Adept_Lifecycle_PhaseId::INVOKE_APPLICATION:
                $component->processInvokeApplication();
                break;
            case Adept_Lifecycle_PhaseId::SAVE_STATE:
                $component->processSaveState();
                break;
            case Adept_Lifecycle_PhaseId::RENDER:
                $component->render();
                break;
            case Adept_Lifecycle_PhaseId::RENDER_AJAX:
                $component->renderAjax();
                break;
            default:
                throw new Adept_Component_Exception('Unsupported phase', 0, array('phaseId' => $phaseId));
        }
    }
    
}
