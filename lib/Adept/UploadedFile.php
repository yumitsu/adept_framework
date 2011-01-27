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

class Adept_UploadedFile extends Adept_Access 
{
    protected $fileOptions = array();
    
    protected $path;
    
    public function __construct($fileOptions = array())
    {
        if (count($fileOptions) > 0){
            $this->setFileOptions($fileOptions);
        }
        $this->path = $this->getTmpName();
    }
    
    public function getContents()
    {
    	return Adept_Util_FileSystem::readFile($this->getPath());
    }
    
    public function move($path, $name = null, $permissions = 0777)
    {
        if ($name != null) {
            $this->setName($name);
        }
        $destination = $path . '/' . $this->getName();
        
        Adept_Util_FileSystem::uploadFile($this->getTmpName(), $destination ,$permissions);
        
        $this->setPath($destination);
    }
    
    public function delete()
    {
        Adept_Util_FileSystem::deleteFile($this->path);
    }
    
    public function __toString()
    {
        return "file_" . $this->getName();
    }
    
    // Array Access------------------------------------------------------------    
    
    public function get($name)
    {
        $name = Adept_Util_String::toUnderScoresNotation($name);
        return isset($this->fileOptions[$name]) ? $this->fileOptions[$name]: null;   
    }
    
     public function set($name, $value)
     {
         $name = Adept_Util_String::toUnderScoresNotation($name);
         $this->fileOptions[$name] = $value;
     }
    
    public function has($name)
    {
        $name = Adept_Util_String::toUnderScoresNotation($name);
        return isset($this->fileOptions[$name]) && $this->fileOptions[$name] != null;
    }
    
    public function remove($name)
    {
        $name = Adept_Util_String::toUnderScoresNotation($name);
        $this->fileOptions[$name] = null;
    }
    
    // Properties---------------------------------------------------------------
    
    public function getExtension()
    {
        $name = $this->getName();
        $pos = strrpos($name, '.');
        if ($pos !== false) {
            return substr($name, $pos + 1);
        }
        return '';
    }
    
    public function getName() 
    {
      return $this->get('name');
    }
    
    public function setName($name) 
    {
      $this->set('name', $name);
    }
    
    public function getTmpName() 
    {
      return $this->get('tmpName');
    }
    
    public function setTmpName($tmpName) 
    {
      $this->set('tmpName', $tmpName);
    }
    
    public function getSize() 
    {
      return $this->get('size');
    }
    
    public function setSize($size) 
    {
      $this->set('size', $size);
    }
    
    public function getError() 
    {
      return $this->get('error');
    }
    
    public function setError($error) 
    {
      $this->set('error', $error);
    }
    
    public function getType() 
    {
      return $this->get('type');
    }
    
    public function setType($type) 
    {
      $this->set('type', $type);
    }
    
    public function getFileOptions() 
    {
       return $this->fileOptions;
    }
    
    public function setFileOptions($fileOptions) 
    {
       $this->fileOptions =  $fileOptions;
    }
    
    public function getPath() 
    {
       return $this->path;
    }
    
    public function setPath($path) 
    {
       $this->path =  $path;
    }
    
}