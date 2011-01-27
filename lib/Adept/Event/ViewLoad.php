<?php

class Adept_Event_ViewLoad extends Adept_Event_Abstract  
{
    
    public function __construct($sender)
    {
        parent::__construct('load', $sender);
    }
    
}