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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Lifecycle
{

    private static $instance;
    
    protected $initPhases = array();
    protected $executePhases = array();
    protected $renderPhases = array();
    
    protected function __construct()
    {
        $this->initPhases = array(
            new Adept_Lifecycle_Phase_Init(),
        );
        
        $this->executePhases = array(
            new Adept_Lifecycle_Phase_RestoreState(),
            new Adept_Lifecycle_Phase_HandleRequest(),
            new Adept_Lifecycle_Phase_Validation(),
            new Adept_Lifecycle_Phase_UpdateModel(),
            new Adept_Lifecycle_Phase_InvokeApplication(),
            new Adept_Lifecycle_Phase_SaveState()
        );
        
        $this->renderPhases = array(
            new Adept_Lifecycle_Phase_Render(),
        );
    }
    
    public function init()
    {
        // Run phases
        foreach ($this->initPhases as $phase) {
            $phase->execute();
        }
    }

    public function execute()
    {
        // Run phases
        foreach ($this->executePhases as $phase) {
            $phase->execute();
        }
    }

    /**
     * @return Adept_Lifecycle
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return Adept_Component_RootView
     */
    public function getRootView()
    {
        return Adept_Context::getInstance()->getRootView();
    }

    public function render()
    {
        foreach ($this->renderPhases as $phase) {
            $phase->execute();
        }
    }

    /**
     * @return Adept_Response_Http
     */
    public function getResponse()
    {
        return Adept_Context::getInstance()->getResponse();
    }
    
    public function getContext()
    {
        return Adept_Context::getInstance();
    }

}
