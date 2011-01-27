<?php

class Adept_Validator_FileSize extends Adept_Validator_Abstract
{


    public function validate($sender, $value)
    {
        if ($value == null){
            return ;
        }
        
    
        if($value instanceof Adept_List){
            foreach ($value as $current){
                $this->check($sender, $current);
            }
        }else{
            $this->check($sender, $value);
        }


        
    }
    
    private function check($sender, $value)
    {
    	if (!is_array($value) && !($value instanceof Adept_UploadedFile)){
            throw new Adept_Exception_IllegalArgument('Illegal binding parameter');
        }
        
        if ($value['size'] < $this->getMinSize() || $value['size'] > $this->getMaxSize()){
            $title = $this->getComponentTitle($sender);
            $message = $this->getMessage('invalid_file_size');
            
            throw new Adept_Validator_Exception($message, 
                Adept_Message::ERROR, array('field' => $title));          
        }     
    }
    

    public function getMinSize()
    {
        return $this->getParameter('minSize', 0);
    }

    public function getMaxSize()
    {
        return $this->getParameter('maxSize', 102400);
    }

}