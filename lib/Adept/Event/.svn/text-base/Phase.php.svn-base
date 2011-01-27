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
 * @package    Adept_Event
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Event_Phase extends Adept_Event_Abstract 
{

    protected $before;
    protected $phaseId;
    
    public function __construct($sender, $phaseId, $before = true)
    {
        $this->phaseId = $phaseId;
        $this->before = $before;
        parent::__construct($this->generateName(), $sender);
    }

    /**
     * Generates name of this event.
     *
     * @return string
     * @throws Adept_Exception_IllegalState If phaseId is not set correctly.
     */
    protected function generateName()
    {
        static $phasesMap = array(
            Adept_Lifecycle_PhaseId::INIT                => 'Init',        
            Adept_Lifecycle_PhaseId::RESTORE_STATE       => 'RestoreState',
            Adept_Lifecycle_PhaseId::HANDLE_REQUEST      => 'HandleRequest',
            Adept_Lifecycle_PhaseId::VALIDATION          => 'Validation',
            Adept_Lifecycle_PhaseId::UPDATE_MODEL        => 'UpdateModel',
            Adept_Lifecycle_PhaseId::INVOKE_APPLICATION  => 'InvokeApplication',
            Adept_Lifecycle_PhaseId::SAVE_STATE          => 'SaveState',
            Adept_Lifecycle_PhaseId::RENDER              => 'Render',
            Adept_Lifecycle_PhaseId::RENDER_AJAX         => 'RenderAjax',
        );

        if (isset($phasesMap[$this->getPhaseId()])) {
            return ($this->isBefore() ? 'before' : 'after') . $phasesMap[$this->getPhaseId()];
        } else {
            throw new Adept_Exception_IllegalState();
        }
    }
    
    public function getPhaseId() 
    {
        return $this->phaseId;
    }
    
    public function setPhaseId($phaseId) 
    {
        $this->phaseId = $phaseId;
    }
    
    public function isBefore()
    {
        return $this->before;
    }
    
    public function isAfter()
    {
        return !$this->before;
    }

}