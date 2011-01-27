<?php
class Adept_Converter_File extends Adept_Converter_Abstract 
{
    
    /**
     * @param Adept_Component_FileUpload $sender
     * @param array $value
     * @return Adept_UploadedFile
     */
    public function getAsModel($sender, $value)
    {
        return new Adept_UploadedFile($value);
    }
    
    /**
     * @param Adept_Component_FileUpload $sender
     * @param Adept_UploadedFile $value
     * @return array 
     */
    public function getAsView($sender, $value)
    {
        if ( !($value  instanceof Adept_UploadedFile)){
            throw new Adept_Exception_IllegalArgument("Unsupported type");
        }
        return $value->getFileOptions();
    }
    
}

