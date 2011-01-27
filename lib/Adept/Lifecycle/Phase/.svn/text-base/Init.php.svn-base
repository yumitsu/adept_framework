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

class Adept_Lifecycle_Phase_Init extends Adept_Lifecycle_Phase_Abstract 
{

    public function execute()
    {
        $this->getLogger()->fine('Entering [Init] phase');
        
        $root = $this->getContext()->getRootView();
        $root->processInit();
        
        $this->getLogger()->fine('Exiting [Init] phase');    
    }

    public function getPhaseId()
    {
        return Adept_Lifecycle_PhaseId::INIT;
    }
    
    /**
     * @return Adept_Context
     */
    public function getContext()
    {
        return Adept_Context::getInstance();
    }
    
    /**
     * @return Adept_Logger
     */
    public function getLogger()
    {
        return Adept_Logger::getLogger(get_class($this));
    }
    
} 