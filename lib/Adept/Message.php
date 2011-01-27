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

class Adept_Message 
{
    
    /* Default message types */
    
    const WARNING = 1;
    const ERROR = 2;
    const INFORM = 3;
    const HINT = 4;

    protected $group;
    
    protected $type;
    protected $title;
    protected $details;

     public function __construct($title, $type = self::INFORM, $group = null, $details = null) 
     {
         $this->title = $title;
         $this->type = $type;
         $this->details = $details;
         $this->group = $group;
     }    
     
     public function getGroup()
     {
         return $this->group;
     }
     
     public function setGroup($group)
     {
         $this->group = $group;
     }     

     public function getType()
     {
       return $this->type;
     }
     
     public function setType($type) 
     {
       $this->type = $type;
     }
     
     public function getTitle() 
     {
       return $this->title;
     }
     
     public function setTitle($title) 
     {
       $this->title = $title;
     }

     public function getDetails() 
     {
         return $this->details;
     }
     
     public function setDetails($details) 
     { 
         $this->details = $details;
     }
     
}
