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
 * @package    Adept_Template
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Template_Location 
{

    protected $fileName;
    protected $lineNumber;

    public function __construct($fileName = 'Unknown file', $lineNumber = 'Unknown line') 
    {
        $this->fileName = $fileName;
        $this->lineNumber = $lineNumber;
    }

    public function getFileName() 
    {
        return $this->fileName;
    }

    public function setFileName($fileName) 
    {
        $this->fileName = $fileName;
    }

    public function getLineNumber() 
    {
        return $this->lineNumber;
    }

    public function setLineNumber($lineNumber) 
    {
        $this->lineNumber = $lineNumber;
    }

}
