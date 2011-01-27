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

class Adept_Filter_Chain 
{
    
    /**
     * @var Adept_List
     */
    protected $filters;
    
    protected $current = 0;
    
    public function __construct()
    {
        $this->filters = new Adept_List();
    }
    
    /**
     * @param Adept_Filter_Interface $filter
     */
    public function append($filter)
    {
        $this->filters->add($filter);
    }
    
    public function next()
    {
        $nextFilter = $this->filters->get($this->current);
        
        if ($nextFilter == null) {
            return null;
        }
        
        $this->getLogger()->info('Starting filter ' . get_class($nextFilter));
        
        $this->current++;
        $result = $nextFilter->process($this);
        
        $this->getLogger()->info('End of filter ' . get_class($nextFilter));
        // Move pointer to the next filter         
        
        return $result;
    }
    
    public function reset()
    {
        $this->current = 0;
    }
    
    /**
     * Return next filter instance.
     *
     * @return Adept_Filter_Interface
     */
    public function getNextFilter() 
    {
        return isset($this->filters[$this->current + 1]) ? $this->filters[$this->current + 1] : null;
    }    
    
    /**
     * Return current filter instance.
     *
     * @return Adept_Filter_Interface
     */
    public function getCurrentFilter() 
    {
        return $this->filters[$this->current];
    }    

    /**
     * Return logger object
     *
     * @return Adept_Logger
     */
    protected function getLogger()
    {
        return Adept_Logger::getLogger(__CLASS__);
    }
    
}