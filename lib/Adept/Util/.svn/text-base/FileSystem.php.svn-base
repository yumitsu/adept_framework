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
 * @package    Adept_Util
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Util_FileSystem 
{

    /**
     * Create folder
     *
     * @param string $folderName Folder name
     * @param int $permissions Unix access permissions 
     * 
     * @throws Adept_Exception_FileSystem If file not exists
     */
    static public function createFolder($folderPath, $permissions = 0777)
    {
        if (file_exists($folderPath)) {
            return ;
        }
        @mkdir ($folderPath, $permissions, true);
    }
    
    /**
     * Checks is file exists
     *
     * @param string $fileName
     * @return boolean 
     * 
     * @deprecated Strange wrapper
     */
    static function isExists($fileName)
    {
        return file_exists($fileName);
    }
    
    /**
     *  Safely read file
     *
     * @param string $fileName Path to source file
     * @return string File content
     */
    static function readFile($fileName)
    {
        if (!($fp = @fopen($fileName, 'r'))) {
            throw new Adept_Exception_FileSystem('File not found', 0, array('file' => $fileName));
        }
        $fsize = filesize($fileName);
        if ($fsize) {
            $source = fread($fp, $fsize);
        } else {
            $source = '';
            while (!feof($fp)) {
                $source .= fread($fp, 4096);
            }
        }
        fclose($fp);
        return $source;
    }
    
    static function saveFile($fileName, $data)
    {
        $fp = fopen($fileName, 'a');
        if(!$fp){
            throw new Adept_Exception_FileOpen("Can not open file {$fileName}");
        }
        flock($fp, LOCK_EX);
        ftruncate ($fp,0);
        fwrite($fp, $data);
        fflush ($fp);
        flock ($fp, LOCK_UN);
        fclose ($fp);
    }
    
    
    
    
    

    /**
     * Delete folder. 
     *
     * @param string $folderName
     * @param string $removeRoot
     * @param boolean $recursive
     */
    static public function deleteFolder($folderName, $removeRoot = false, $recursive = true)
    {
        $dir = opendir($folderName);
        while(($file = readdir($dir))) {
            if (is_file ($folderName . '/' . $file)) {
                @unlink($folderName . '/' . $file);
            } elseif ($recursive && is_dir($folderName . '/' . $file) && ($file != '.') && ($file != '..')) {
                Adept_Util_FileSystem::deleteFolder($folderName . '/' . $file, true, true);
            }
        }
        closedir($dir);
        if ($removeRoot) {
            @rmdir($folderName);
        }
    }

    /**
     * Move uploaded file to target directory and set permissions on it
     *
     * @param string $sourceFile Path to temporary uploaded file 
     * @param string $destFile Target file location and name
     * @param integer $permissions Unix access permissions, default 0777
     * 
     * @throws Adept_Exception_FileSystem Throws if upload failed
     */
    static public function uploadFile($sourceFile, $destFile, $permissions = 0777)
    {
        $destPathArr = pathinfo($destFile);
        $location = $destPathArr['dirname'];
        $filename = $destPathArr['basename']; 
        self::createFolder($location);    
        if (!is_executable($filename)) {
            move_uploaded_file($sourceFile, $location . "/" . $filename);
            chmod($location . "/" . $filename, $permissions);
        } else {
            throw new Adept_Exception_FileSystem('File Upload Error');
        }
    }

    static public function deleteFile($filename) {
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

}
