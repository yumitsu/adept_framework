<?php
class Adept_ImageKit
{
    protected static $instance = null;
    protected static $providers = array(
        'gd' => 'Adept_ImageKit_Gd_Provider',
    ); 
    
    /**
     * @return Adept_ImageKit
     */
    public static function getInstance()
    {
    	if (self::$instance === null){
    	    self::$instance = new self();
    	    
    	}
    	return self::$instance;
    }
    
    public function create($library = 'gd')
    {   
    	if (!isset(self::$providers[$library])){
    	    throw new Adept_Exception_IllegalArgument("Unsupported library $library");
    	}
    	return  Adept_ClassKit_Util::createObject(self::$providers[$library]);
    	 
    }
    /**
     * @param unknown_type $fileName
     * @param unknown_type $type
     * @param unknown_type $library
     * @return Adept_ImageKit_Provider
     */
    public function load($fileName, $type = '', $library = 'gd')
    {
    	$provider = $this->create($library);
    	$provider->load($fileName, $type);
    	return $provider;
    }
    
    
    
}
