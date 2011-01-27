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
 * @package    Adept_Test
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Test_WebRunner_Controller_SuiteList extends Adept_Test_WebRunner_Controller_AbstractController 
{
    protected $suites = array();
    
    public function execute()
    {
        $this->suites = $this->findTestSuites('../test_suite');
        $this->renderView("Adept/Test/WebRunner/View/suite_list.tpl");
    }
    
    private function findTestSuites($dir)
    {
        $iterator = new DirectoryIterator($dir);
        
        $suites = array();
        
        foreach ($iterator as $path)
        {
            if($iterator->isDot())
            {
                continue;
            }
            
            if($iterator->isDir())
            {
                continue;
            }
            elseif
            ($iterator->isFile())
            {
                $fileName = $iterator->getFilename();
                
                $arr = explode('.', $fileName);
                $suiteName = $arr[0];
                
                $suite = new $suiteName();
                $suite->setName($suiteName);
                $suites[] = $suite;
            }
        }
        
        return $suites;
    }
}
