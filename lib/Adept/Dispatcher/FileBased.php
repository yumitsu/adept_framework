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
 * @package    Adept_Dispatcher
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Dispatcher_FileBased extends Adept_Dispatcher
{

    protected $suffix;
    protected $directoryIndex;
    protected $pageDirectory;
    protected $rootPath;

    public function __construct($suffix = '.tpl', $directoryIndex = 'index.tpl', $pageDirectory = 'page')
    {
        $this->suffix = $suffix;
        $this->directoryIndex = $directoryIndex;
        $this->pageDirectory = $pageDirectory;
    }

    /**
     * @param Adept_Request_Http $request
     * @param Adept_Response_Httpl $response
     * @return boolean
     */
    public function dispatch($request, $response)
    {
        $parts = Adept_Util_Uri::getPathElements($request->getUrl()->getPath());

        // Sanitize path
        $path = $this->getRootPath();

        $endsWith = (strlen($path)) > 0 ? substr($path, strlen($path) - 1, 1) : '';
        
        if ($endsWith != '/'  || $endsWith != '\\') {
            $path = $path . '/';
        } 
        
        $clearParts = array();
        foreach ($parts as $part) {
            if ($part == '.' || $part == '..') {
                continue;
            }
            $clearParts[] = $part;
        }
        
        $path .= implode('/', $parts);
        
        if (is_dir($path)) {
            $path .= $this->directoryIndex; 
        } else {
            $path .= $this->suffix;
        }
        
        if (file_exists($path)) {
            $request->setController('Adept_Controller_Lifecycle');
            $request->setParameter(Adept_Controller_Lifecycle::TEMPLATE, $path);
            return true;
        }
            
        return false;
    }
    
    public function getRootPath()
    {
        return PROJECT_TEMPLATE_DIR . '/' . $this->pageDirectory;
    }

}