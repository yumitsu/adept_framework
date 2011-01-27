<?php

class Adept_ImageKit_Gd_Container extends Adept_ImageKit_Container
{
    protected $image = null;

    protected $imageType;

    static protected $supportedImageTypes = array(
        self::TYPE_GIF, self::TYPE_JPEG, self::TYPE_PNG
    );

    static protected $lookupType = array(
        IMAGETYPE_GIF => 'gif',
        IMAGETYPE_JPEG => 'jpeg',
        IMAGETYPE_PNG => 'png',
        IMAGETYPE_WBMP => 'wbmp'
    );

    public function __destruct()
    {
        $this->destroyImage();
    }

    public function load($fileName, $type = '')
    {
        $this->destroyImage();

        if (!file_exists($fileName)){
            throw new Adept_Exception_IllegalArgument('File not found', array('path' => $fileName));
        }

        $imageInfo = getimagesize($fileName);
        
        if ($type == '') {
            $type = $this->detectImageType($imageInfo[2]);
        }
        
        $type = strtolower($type);
        if (!in_array($type, self::$supportedImageTypes)) {
            throw new Adept_Exception_IllegalArgument("Unsupported image type {$type}");
        }

        $this->imageType = $type;

        $createfunc = 'imagecreatefrom' . $type;
        if(!($this->image = $createfunc($fileName))){
            throw new Adept_Exception("Cannot create file {$fileName}");
        }

    }

    public function save($fileName = null, $quality = 90)
    {
        switch ($this->imageType) {
        	case self::TYPE_GIF:
        	   $result = imagegif($this->image, $fileName);
        	break;
        	case self::TYPE_JPEG:
               $result = imagejpeg($this->image, $fileName, $quality);
    	    break;
        	case self::TYPE_PNG:
               $result = imagepng($this->image, $fileName, $quality);
    	    break;
        }
        
        if (!$result) {
            throw new Adept_Exception("Cann't save file");
        }
        $this->destroyImage();
    }
    
    public function getColor($r, $g, $b)
    {
        if (($res = imagecolorexact($this->getImage(), $r, $g, $b)) !== -1){
            return $res;
        }
        if (($res = imagecolorallocate($this->getImage(), $r, $g, $b)) !== -1 ){
            return $res;
        }
        if (($res = imagecolorclosest($this->getImage(), $r, $g, $b)) !== -1){
            return $res;
        }
        throw new Adept_Exception("Color allocation failed for color r: '{$r}', g: '{$g}', b: '{$b}'." );
    }
    
    public function toTrueColor($width = null, $height = null)
    {
        if (!$this->isTrueColor()){
            if ($width === null){
                $width = $this->getWidth();
            }
            if ($height === null){
                $height = $this->getHeight();
            }
        	$newResource = imagecreatetruecolor($width, $height);
        	   
            imagecopy($newResource, $this->getImage(), 0, 0, 0, 0, $width, $height);
            $this->replaceImage($newResource);
        }
    }
    
    public function isTrueColor()
    {
    	return imageistruecolor($this->getImage());
    }
    
    public function detectImageType($type)
    {
        
        return isset(self::$lookupType[$type]) ? self::$lookupType[$type] : '';
    }
    
    public function replaceImage($image)
    {
    	$this->destroyImage();
    	$this->image = $image;
    }

    protected function destroyImage()
    {
        if ($this->image !== null){
            imagedestroy($this->image);
            $this->image = null;
        }
    }
    
    public function getImage()
    {
        return $this->image;
    }

    function getWidth()
    {
        return imagesx($this->image);
    }

    function getHeight()
    {
        return imagesy($this->image);
    }

}