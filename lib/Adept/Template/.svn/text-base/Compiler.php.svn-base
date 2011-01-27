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

class Adept_Template_Compiler
{

    protected $compiledClass;
    protected $executor;

    public function __construct($executor, $compiledClass = 'TplDefaultClass')
    {
        $this->compiledClass = $compiledClass;
        $this->executor = $executor;
    }
    
    /**
     * @param Adept_Template_PhpWriter $writer
     */
    public function generateHeader($writer)
    {
        $writer->beginClass($this->getCompiledClass());
        $writer->beginFunction('doBody', '$root, $context', 'public');
    }

    /**
     * @param Adept_Template_PhpWriter $writer
     */
    public function generateFooter($writer)
    {
        $writer->endFunction();
        $writer->endClass();
    }

    protected function optimize($tree)
    {
        ;
    }
    
    /**
     * @param Adept_Template_Node $tree
     */
    public function compile($tree)
    {
        $writer = new Adept_Template_PhpWriter();
            
        $tree->preParse($this->executor);
        $tree->prepare();   
        
        $this->optimize($tree);
        
        $this->generateHeader($writer);
        $tree->generate($writer);
        $this->generateFooter($writer);

        return $writer->getCode();
    }

    public function getCompiledClass()
    {
        return $this->compiledClass;
    }

    public function setCompiledClass($compiledClass)
    {
        $this->compiledClass = $compiledClass;
    }    

}