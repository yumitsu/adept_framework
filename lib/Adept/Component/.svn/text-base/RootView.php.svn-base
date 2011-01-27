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

if (!defined('ADEPT_UI_PERSISTENT')) {
    define('ADEPT_UI_PERSISTENT', false);
}

class Adept_Component_RootView extends Adept_Component_AbstractView 
{

   /**
     * @var Adept_Map
     */
    protected $beforePhaseListeners = null;
    
    /**
     * @var Adept_Map
     */
    protected $afterPhaseListeners = null;
    
    protected $uniqueId;

    protected $stateStorage = null;
    
    private static $idGenerator = 1;
    
    // Constructor ------------------------------------------------------------
    
    public function __construct($uniqueId = null) 
    {
        parent::__construct(null, '_root');
        $this->uniqueId = $uniqueId;
    }
    
    public function isPersistent()
    {
        return ADEPT_UI_PERSISTENT;
    }
    
    public function hasRenderer()
    {
        return false;
    }
    
    public function isAlreadyLoaded()
    {
        $request = $this->getContext()->getRequest();
        return ($request->isPost() || $request->isAjax() || $request->has('event') 
           || $request->has('action'));
    }
    

    
    // Properties -------------------------------------------------------------
    
    public function getParent() 
    {
        return null;
    }
    
    /**
     * Returns $this instance.
     *
     * @return Adept_Component_RootView
     */
    public function getRootView() 
    {
        return $this;
    }    
    
    public function getUniqueId()
    {
        return $this->uniqueId;
    }
    
    public function setUniqueId($uniqueId) 
    {
        $this->uniqueId = $uniqueId;
    }    
    
    public function generateId($object = null)
    {
        $class  = ($object == null) ? 'component' : get_class($object);
        $parts = explode("_", $class);
        $prefix = strtolower($parts[count($parts) - 1]);
        
        $id = $prefix . self::$idGenerator++;
        
        return $id;
    }
    
    /**
     * @return Adept_Session_Namespace
     */
    public function getViewSession()
    {
    	return $this->getContext()->getHttpSession()->getNamespace($this->getUniqueId());
    }
    
    // Event queue ------------------------------------------------------------
    
    /**
     * @return Adept_List
     */
    protected function getEventsQueue()
    {
        if ($this->eventsQueue == null) {
            $this->eventsQueue = new Adept_List();
        }
        return $this->eventsQueue;
    }
    
    public function queueEvent($event)
    {
        $this->getEventsQueue()->add($event);
    }
    
    public function clearEvents()
    {
        $this->getEventsQueue()->removeAll();
    }
    
    public function broadcastEvents()
    {
        foreach ($this->getEventsQueue() as $event) {
            $event->broadcast();
        }
    }
    
    // Phase Events -----------------------------------------------------------
    
    /**
     * @return Adept_Map
     */
    protected function getBeforePhaseListeners()
    {
        if ($this->beforePhaseListeners == null) {
            $this->beforePhaseListeners = new Adept_Map();
        }
        return $this->beforePhaseListeners;
    }
    
    /**
     * @return Adept_Map
     */
    protected function getAfterPhaseListeners()
    {
        if ($this->afterPhaseListeners == null) {
            $this->afterPhaseListeners = new Adept_Map();
        }
        return $this->afterPhaseListeners;
    }
    
    public function notifyPhaseListeners($phaseId, $before = true)
    {
        $listeners = $this->getPhaseListeners($phaseId, $before);
        if (count($listeners) > 0) {
            $event = new Adept_Event_Phase($this, $phaseId, $before);
            Adept_ClassKit_Delegate_List::invokeChain($listeners->toArray(), array($event));
        } 
    }

    public function addPhaseListener($phaseId, $listener, $before = true) 
    {
        if ($phaseId == Adept_Lifecycle_PhaseId::ANY) {
            $phases = new Adept_Lifecycle_PhaseId();
            foreach ($phases as $phase) {
                if ($phase != Adept_Lifecycle_PhaseId::ANY) {
                    $this->addPhaseListener($phase, $listener, $before);
                }
            }
            return ;
        }
    
        $map = ($before) ? $this->getBeforePhaseListeners() : $this->getAfterPhaseListeners();
        if ($map->has($phaseId)) {
            $map->get($phaseId)->add($listener);
        } else {
            $map->set($phaseId, new Adept_List(array($listener)));
        }
    }

    /**
     * Returns {@link Adept_List} or $phaseId listeners.
     *
     * @param string $phaseId
     * @param boolean $before
     * @return Adept_List
     */
    public function getPhaseListeners($phaseId, $before = true) 
    {
        $map = ($before) ? $this->getBeforePhaseListeners() : $this->getAfterPhaseListeners();
        return $map->has($phaseId) ? $map->get($phaseId) : new Adept_List();
    }    
    
    // State storage ----------------------------------------------------------
    
    /**
     * Returns view state storage instance.
     *
     * @return Adept_StateStorage_View
     */
    public function getStateStorage()
    {
        if (null == $this->stateStorage) {
            $this->stateStorage = $this->getContext()->getStateStorage()->getViewStorage($this->getUniqueId());
        }
        return $this->stateStorage;
    }
    
    // Lifecycle Phases -------------------------------------------------------
    
    public function processPhase($phaseId)
    {
        $this->notifyPhaseListeners($phaseId, true);
        $this->clearEvents();
        switch ($phaseId) {
            case Adept_Lifecycle_PhaseId::INIT:
                parent::processInit();
                break;
            case Adept_Lifecycle_PhaseId::RESTORE_STATE:
                parent::processRestoreState();
                break;
            case Adept_Lifecycle_PhaseId::HANDLE_REQUEST:
                // nofity onLoad
                parent::processHandleRequest();
                break;
            case Adept_Lifecycle_PhaseId::VALIDATION:
                parent::processValidation();
                break;
            case Adept_Lifecycle_PhaseId::UPDATE_MODEL:
                parent::processUpdateModel();
                break;
            case Adept_Lifecycle_PhaseId::INVOKE_APPLICATION:
                parent::processInvokeApplication();
                break;
            case Adept_Lifecycle_PhaseId::SAVE_STATE:
                parent::processSaveState();
                break;
            case Adept_Lifecycle_PhaseId::RENDER:
                parent::renderChildren();
                break;
            case Adept_Lifecycle_PhaseId::RENDER_AJAX:
                parent::renderAjax();
                break;
           default:
                throw new Adept_Exception_IllegalArgument();
        }
        $this->broadcastEvents();
        $this->notifyPhaseListeners($phaseId, false);
    }
    
    public function processInit()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::INIT);
    }
    
    public function processRestoreState()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::RESTORE_STATE);
    }
    
    public function processHandleRequest()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::HANDLE_REQUEST);
    }
    
    public function processValidation()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::VALIDATION);
    }
    
    public function processUpdateModel()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::UPDATE_MODEL);
    }
    
    public function processInvokeApplication()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::INVOKE_APPLICATION);
    }
    
    public function processSaveState()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::SAVE_STATE);
    }    
    
    public function renderChildren()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::RENDER);
    }    
    
    
    public function renderAjax()
    {
        $this->processPhase(Adept_Lifecycle_PhaseId::RENDER_AJAX);
    }        
    
}