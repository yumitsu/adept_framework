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

class Adept_Util_Image
{
    const MAX_PICTURE_SIZE = 524288; //1024*1024*0.5

    /**
     * Create Thumb
     *
     * @param string $picPath Path to original image
     * @param string $thumbPicPath Path to thump pic
     * @param int $thumbPicMaxSizeX Max width length
     * @param int $thumbPicMaxSizeY Max height length
     * @param string $newExtension New pic extension
     */
    static public function makeThumb($picPath, $thumbPicPath, $thumbPicWidthMaxSize, $thumbPicHeightMaxSize = null, $newExtension = null) {
        $types = array(1 => 'GIF', 2 => 'JPG', 3 => 'PNG', 4 => 'SWF', 5 => 'PSD', 6 => 'BMP',
        7 => 'TIFF',//(intel byte order)
        8 => 'TIFF',//(motorola byte order)
        9 => 'JPC', 10 => 'JP2', 11 => 'JPX', 12 => 'JB2', 13 => 'SWC', 14 => 'IFF', 15 => 'WBMP', 16 => 'XBM');

        list($w, $h, $type) = getimagesize($picPath);
        $extension = strtolower($types[$type]);

        if (is_null($thumbPicHeightMaxSize)) {
            $thumbPicHeightMaxSize = $thumbPicWidthMaxSize;
        }

        if ($w > $h) {
            if($thumbPicWidthMaxSize < $w){
                $off_w = ($w - $h)/2;
                $w = $h;
            }
            else{
                //$w = $w*2;
                //$h = $h*2;
            }
            $off_h = 0;

        } elseif ($h > $w) {
            $off_w = 0;
            if($thumbPicHeightMaxSize < $h){
                $off_h = ($h - $w)/2;
                $h = $w;
            }
        } else{
            $off_w = 0;
            $off_h = 0;
        }
        $trumbX = 0;
        $trumbY = 0;
        $thumbPicMaxSizeX = $thumbPicWidthMaxSize;
        $thumbPicMaxSizeY = $thumbPicHeightMaxSize;

        if($thumbPicWidthMaxSize >= $w){
            $trumbX = ($thumbPicWidthMaxSize - $w)/2;
            $thumbPicMaxSizeX = $w;
        }
        if($thumbPicHeightMaxSize >= $h){
            $trumbY = ($thumbPicHeightMaxSize - $h)/2;
            $thumbPicMaxSizeY = $h;
        }
        switch ($extension){
            case 'jpg':
                $big = imagecreatefromjpeg($picPath);
                break;
            case 'gif':
                $big = imagecreatefromgif($picPath);
                break;
            case 'png':
                $big = imagecreatefrompng($picPath);
                break;
            case 'bmp': /*эта ветка пока не работает. хотел создать jpg c bmp*/
            $big = imagecreatefromwbmp($picPath);
            break;
        }

        $thumb = imagecreatetruecolor($thumbPicWidthMaxSize, $thumbPicHeightMaxSize);

        $white = imagecolorallocate($thumb, 255, 255, 255);
        imagefill($thumb,0,0,$white);
        imagecopyresampled($thumb, $big, $trumbX, $trumbY, $off_w, $off_h, $thumbPicMaxSizeX, $thumbPicMaxSizeY, $w, $h);

        if(!$newExtension)$newExtension = $extension;
        switch ($newExtension){
            case 'jpg':
                imagejpeg($thumb,$thumbPicPath, 92);
                break;
            case 'gif':
                imagegif($thumb,$thumbPicPath);
                break;
            case 'png':
                imagepng($thumb,$thumbPicPath);
                break;
        }
    }

/**
 * Resize given picture by max width, useful for social networks (facebook style)
 *
 * @param string Path to original image
 * @param string Path to resized image
 * @param int Maximum width of resized image
 */
    
    static public function makeResizedPhoto($picPath, $thumbPicPath, $thumbPicWidthMaxSize)
    {
        $types = array(1 => 'GIF', 2 => 'JPG', 3 => 'PNG', 4 => 'SWF', 5 => 'PSD', 6 => 'BMP',
        7 => 'TIFF',//(intel byte order)
        8 => 'TIFF',//(motorola byte order)
        9 => 'JPC', 10 => 'JP2', 11 => 'JPX', 12 => 'JB2', 13 => 'SWC', 14 => 'IFF', 15 => 'WBMP', 16 => 'XBM');

        list($w, $h, $type) = getimagesize($picPath);
        $extension = strtolower($types[$type]);
        
        //calculate the image ratio
        
        $imgratio=$w/$h;
        
        if ($imgratio>1)
        {
            $newwidth = $thumbPicWidthMaxSize;
            $newheight = $thumbPicWidthMaxSize/$imgratio;
            $thumbX = 0;
        } else {
            $newheight = $thumbPicWidthMaxSize/$imgratio;
            $newwidth = $thumbPicWidthMaxSize;
            
            if($thumbPicWidthMaxSize >= $w)
            {
//                $thumbX = ($thumbPicWidthMaxSize - $w) / 2;
                $newwidth = $w;
                $newheight = $h;
                $thumbPicWidthMaxSize = $w;
                $thumbX = 0;
            } else {
                $thumbX = 0;
            }
        }
        $thumb = imagecreatetruecolor($thumbPicWidthMaxSize,$newheight);
        
        switch ($extension){
            case 'jpg':
                $big = imagecreatefromjpeg($picPath);
                break;
            case 'gif':
                $big = imagecreatefromgif($picPath);
                break;
            case 'png':
                $big = imagecreatefrompng($picPath);
                break;
            case 'bmp': /*эта ветка пока не работает. хотел создать jpg c bmp*/
                $big = imagecreatefromwbmp($picPath);
                break;
        }

        imagefill($thumb,0,0,imagecolorallocate($thumb, 255, 255, 255));
        imagecopyresampled($thumb, $big, $thumbX, 0, 0, 0, $newwidth, $newheight, $w, $h);
        
        switch ($extension){
            case 'jpg':
                imagejpeg($thumb,$thumbPicPath, 92);
                break;
            case 'gif':
                imagegif($thumb,$thumbPicPath);
                break;
            case 'png':
                imagepng($thumb,$thumbPicPath);
                break;
        }
    }
    
    
    /**
     * Validate Image
     *
     * @param $image Upload file (image)
     *
     * @throws Adept_Exception_Image If there was some trouble with image
     */
    static public function validateImage($image){
        if (empty($image['name'])) {
            throw new Adept_Exception_Image('Image Upload Error', Adept_Exception_Image::IMAGE_ERR_INVALID_NAME);
        }
        $ext = pathinfo($image['name']);
        $mimeType = $image['type'];

        $enabledExt = array('image/png','image/x-png','image/gif','image/pjpeg','image/jpeg');//,'bmp'

        if (!in_array($mimeType, $enabledExt)) {
            throw new Adept_Exception_Image('Image Upload Error: ' . $mimeType . ' - Invalid file type', Adept_Exception_Image::IMAGE_ERR_INVALID_TYPE);
        }
        if (isset($ext["size"]) && $ext["size"] > self::MAX_PICTURE_SIZE) {
            throw new Adept_Exception_Image('Image Upload Error: Invalid file size! Upload file less' . self::MAX_PICTURE_SIZE . ' bytes', Adept_Exception_Image::IMAGE_ERR_INVALID_SIZE);
        }
        if(!@getimagesize($image['tmp_name'])){
            throw new Adept_Exception_Image('Image Upload Error: Unknown image', Adept_Exception_Image::IMAGE_ERR_UNKNOWN_IMAGE);
        }

//        $image['ext'] = substr($mimeType, strpos($mimeType,'/')+1);
        $image['ext'] = $ext['extension'];
        return $image;
    }

    public static function getImageExtension($image)
    {
        $pathArr = pathinfo($image['name']);
        return $pathArr['extension'];
    }
    
}