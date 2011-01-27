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

class Adept_Template_ViewExecutor extends Adept_Template_Executor
{
    
    protected $instance; 
    
    public function createCompiler()
    {
        return new Adept_Template_ViewCompiler($this, $this->getCompiledClass());
    }
    
    public function createBuilder($root = null)
    {
        return new Adept_Template_ViewBuilder($this, $root);
    }
        
    public function createDictionary()
    {
        $dictionary = new Adept_Template_Dictionary();
        $dictionary->importLibrary('acl', 'Adept/Template/TagLib/Acl.tld');
        $dictionary->importLibrary('tpl', 'Adept/Template/TagLib/CoreView.tld');
        $dictionary->importLibrary('c', 'Adept/Template/TagLib/Component.tld');
        $dictionary->importLibrary('tr', 'Adept/Template/TagLib/Transform.tld');
        return $dictionary; 
    }    
    
    public function createTextNode($text)
    {
        $tag = new Adept_Template_TagLib_View_ExpressionTag();
        $tag->setExecutor($this);
        $tag->addTextPart($text);
        return $tag;
    }
    
    public function createExpressionNode($expression)
    {
        $tag = new Adept_Template_TagLib_View_ExpressionTag();
        $tag->setExecutor($this);
        $tag->addExpressionPart($expression);
        return $tag;
    }
    
    protected function createTemplateInstance()
    {
        $class = $this->getCompiledClass();
        return new $class();
    }
    
    protected function getTemplateInstance()
    {
        if (null == $this->instance) {
            if (!$this->isCompiled()) {
                $this->compile();
            }
            include_once($this->getCompiledFile());
            $this->instance = $this->createTemplateInstance();
        }
        return $this->instance;        
    }
    
    public function getRootView()
    {
        $root = new Adept_Component_RootView($this->compiledClass);
        $context = Adept_Context::getInstance();
        $this->getTemplateInstance()->doBody($root, $context);
        return $root;        
    }
    
}
