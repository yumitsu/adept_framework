<?php

class Adept_Ajax_Command_GoogleSynchronize extends Adept_Ajax_Command
{
    
    protected $id;
    protected $data;
    
    public function __construct($id = null, $data = null)
    {
        parent::__construct('Adept.Ajax.Command.GoogleSynchronize');
        $this->id = $id;
        $this->data = $data;
    }
    
    public function getId() 
    {
       return $this->id;
    }
    
    public function setId($id) 
    {
       $this->id =  $id;
    }
    
    public function getData() 
    {
       return $this->data;
    }
    
    public function setData($data) 
    {
       $this->data =  $data;
    }
    
    

}

