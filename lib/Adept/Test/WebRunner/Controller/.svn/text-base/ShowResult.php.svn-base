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

class Adept_Test_WebRunner_Controller_ShowResult extends Adept_Test_WebRunner_Controller_AbstractController 
{
    protected $results;
        
    public function execute()
    {
        $this->results = $this->runTestSuites();
        $this->renderView("Adept/Test/WebRunner/View/show_result.tpl");
    }
    
    private function runTestSuites()
    {
        $results = array();
        
        foreach($_POST as $key => $value)
        {
            if(substr($key,0,5) == "suite")
            {
                $suiteClassName = $value;
                $testSuite = new $suiteClassName();
                $testSuite->runSuite();
                
                $result['result'] = $testSuite->getResult();
                $result['suiteName'] = $value;
                
                $results[] = $result;
            }
        }
        
        return $results;
    }
}
