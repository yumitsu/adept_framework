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

class Adept_Event_Paginate extends Adept_Event_Abstract 
{
    protected $offset;
    protected $limit;
    protected $page;
    
    public function __construct($sender, $page, $limit = 0, $offset = 0)
    {
        parent::__construct('paginate', $sender);
        
        $this->setPage($page);
        $this->setOffset($offset);
        $this->setLimit($limit);
    }
    
    public function getPage() 
    {
        return $this->page;
    }
    
    public function setPage($page) 
    {
        $this->page = $page;
    }
    
    public function getOffset()
    {
        return $this->offset;
    }
    
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }
    
    public function getLimit()
    {
        return $this->limit;
    }
    
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }
    
    public function toString()
    {
        return "Event: Paginate; Page: {$this->getPage()}; Offset: {$this->getOffset()}; Limit: {$this->getLimit()} ";
    }
}
