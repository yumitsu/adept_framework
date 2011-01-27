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
 * @package    Adept_Filter
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

/**
 * Filter initialize database profiling mode and render results 
 */
class Adept_Filter_Profiler_Db extends Adept_Filter_Abstract 
{
    protected $connectionString;
    protected $profiler;

    // Constructor ------------------------------------------------------------
    
    public function __construct($connectionString = null)
    {
        $this->connectionString = $connectionString;
    }

    // Filter -----------------------------------------------------------------
    
    /**
     * @param Adept_Filter_Chain $chain
     */
    public function process($chain)
    {
        $this->profiler = new Adept_Db_Profiler();
        
        $connection = Adept_Db_Factory::getConnection($this->getConnectionString());
        
        $connection->setProfiler($this->profiler);

        $chain->next();
        
        $this->reportHtml();
        $this->reportLogger();
        
    }
    
    protected function reportLogger()
    {
        
    }
    
    protected function reportHtml()
    {
        $request = $this->getContext()->getRequest();
        $response = $this->getContext()->getResponse();
        if (!$request->isAjax()) {
            $response->write('<small>' . __CLASS__ . ': ');
            $response->write($this->profiler->reportToHtml());
            $response->write('</small>');
        }
    }
    
    // Properties -------------------------------------------------------------
    
    public function getConnectionString() 
    {
        return $this->connectionString;
    }
    
    public function setConnectionString($connectionString) 
    {
        $this->connectionString = $connectionString;
    }

}
