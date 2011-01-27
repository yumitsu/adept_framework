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

abstract class Adept_Template_Executor 
{

    protected $compiledClass;
    protected $compiledDir;
    protected $compiledFile;
    
    protected $template;
    protected $fileName;
    
    protected $builder;
    protected $compiler;
    protected $dictionary;
    protected $locator;    
    protected $parser;
        
    public function __construct($template) 
    {
        $this->template = $template;
        $this->compiledDir = PROJECT_VAR_DIR . '/compiled';
    
        $locator = $this->getLocator();
        
        try {
           $this->fileName = $locator->locate($template);
        } catch (Adept_Exception $caused) {
            $exception = new Adept_Template_Exception("Cannot locate template", array('Template' => $template));
            $exception->initCause($caused);
            throw $exception;
        }
        
        $nameOnly = basename($this->fileName);
        $this->md5 = md5_file($this->fileName);
        
        $this->compiledClass = preg_replace('~[^\w]~', '_', 'Template' . $nameOnly . $this->md5);
        $this->compiledFile = $this->compiledDir . '/' . $this->compiledClass . '.php';
    }
    
    public function getLocator()
    {
        if (null == $this->locator) {
            $this->locator = new Adept_Template_Locator();
        }
        return $this->locator;
    }
    
    public function createBuilder($root = null)
    {
        return new Adept_Template_Builder($this, $root);
    }
    
    public function createCompiler()
    {
    }
    
    public function createDictionary()
    {
        return new Adept_Template_Dictionary();
    }
    
    public function createTextNode($text)
    {
    }
    
    public function createExpressionNode($expression)
    {
    }
    
    /**
     * @return Adept_Template_Parser
     */
    public function createParser()
    {
        return new Adept_Template_Parser();
    }

    public function createRootNode()
    {
        return new Adept_Template_RootNode();
    }
    
    public function compile()
    {
        $compiler = $this->createCompiler();
                
        $source = $this->readTemplateSource();
        
        $this->getParser()->setTemplateName($this->getFileName());
        $this->getParser()->parse($source);
        $root = $this->getBuilder()->getRoot();
        
        $code = $this->getCompiler()->compile($root);
        $this->writeCompiledSource($code);            
    }
    
    public function isCompiled()
    {
        if ($this->isForceCompile()) {
            return false;
        }
        return file_exists($this->getCompiledFile());
    }
    
    protected function readTemplateSource()
    {
        return file_get_contents($this->getFileName());
    }
    
    protected function writeCompiledSource($source)
    {
        if (!file_exists($this->compiledDir)) {
            mkdir($this->compiledDir, true);
        }
        Adept_Util_FileSystem::saveFile($this->compiledFile, $source);
        
    }
    
    public function getFileName()
    {
        return $this->fileName;
    }
    
    public function getCompiledClass()
    {
        return $this->compiledClass;
    }
    
    public function getCompiledFile()
    {
        return $this->compiledFile;
    }
    
    public function getTemplateName()
    {
        return $this->template;
    }
        
    public function getBuilder()
    {
        if (null == $this->builder) {
            $this->builder = $this->createBuilder();
        }
        return $this->builder;
    }
    
    public function getParser()
    {
        if (null == $this->parser) {
            $this->parser = $this->createParser();
            $this->parser->setObserver($this->getBuilder());
        }
        return $this->parser;
    }
    
    public function getCompiler()
    {
        if (null == $this->compiler) {
            $this->compiler = $this->createCompiler();
        }
        return $this->compiler;
    }
    
    public function getDictionary()
    {
        if (null == $this->dictionary) {
            $this->dictionary = $this->createDictionary();
        }
        return $this->dictionary;
    }
        
    public function isForceCompile()
    {
        return true;
    }
        
}