<?php
class Adept_Converter_FileList extends Adept_Converter_Abstract 
{
    
    /**
     * @param Adept_Component_FileUpload $sender
     * @param array $value
     * @return Adept_List
     */
    public function getAsModel($sender, $value)
    {
        $result = new Adept_List();
       if(is_array($value)){
           foreach ($value as $current){
               $result->add(new Adept_UploadedFile($current));
           }
       }
        return $result;
    }
    
    /**
     * @param Adept_Component_FileUpload $sender
     * @param mixed $value
     * @return array 
     */
    public function getAsView($sender, $value)
    {
        if ($value  instanceof Adept_UploadedFile){
            return $value->getFileOptions();
        }
        
        if($value instanceof Adept_List){
            $result  = array();
            
            foreach ($value as $current){
                $result[] = $current->getFileOptions(); 
            }
            return $result;
        }
        
        return array();
        
    }
    
}

