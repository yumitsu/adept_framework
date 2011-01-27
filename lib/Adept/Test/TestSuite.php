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

class Adept_Test_TestSuite extends PHPUnit_Framework_TestSuite
{
    /**
     * @var PHPUnit_Framework_TestResult
     */
    private $result;

    public function __construct()
    {
        parent::__construct();
        $this->init();        
        $this->result  = new PHPUnit_Framework_TestResult();
    }
    
    public function addTests($className)
    {
        Adept_ClassLoader::loadClass($className);
        $this->addTestSuite($className);
    }
    
    public function runSuite()
    {
        $this->run($this->result);
    }

    /**
     * @return PHPUnit_Framework_TestResult
     */
    public function getResult()
    {
        return $this->result;
    }

    protected function setUp()
    {
        
    }

    public function init()
    {
        //$this->addTestSuite('MyFirstTest');//for example
    }
 
    protected function tearDown()
    {
        
    }
}