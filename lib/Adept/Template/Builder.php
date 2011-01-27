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

class Adept_Template_Builder implements Adept_Template_ParsingObserver  
{
    
    /**
     * @var Adept_Template_RootNode
     */
    protected $root;
    
    /**
     * @var Adept_Template_Node
     */
    protected $current;
    
    protected $lastNode = null;

    /**
     * @var Adept_Template_Parser
     */
    protected $parser;
    
    /**
     * @var Adept_Template_Executor
     */
    protected $executor;
    
    protected $stripLevel = 0;
    
    public function __construct($executor, $root = null) 
    {
        $this->executor = $executor;
        $this->root = $root !== null ? $root : $executor->createRootNode();
        $this->current = $this->root;
    }   
    
    public function comment($comment)
    {
//        $this->expression('<!--' . $comment . '-->');
    }

    public function processingInstruction($instruction, $parameters)
    {
    }

    /**
     * @param Adept_Template_Tag $class
     */
    protected function createTag($class, $prefix, $name)
    {
        if (!class_exists($class)) {
            throw new Adept_Exception("Cannot create tag object for tag '{$prefix}:{$name}' ");
        }
        $tag = new $class($name);
        $tag->setExecutor($this);
        return $tag;
    }
    
    protected function splitTag($tag)
    {
        if (strpos($tag, ':') === false) {
            return array('prefix' => null, 'name' => $tag);
        } else {
            list($tagPrefix, $tagName) = explode(':', $tag, 2);
            return array('prefix' => $tagPrefix, 'name' => $tagName);
        }
    }
    
    protected function processTagLib($attributes)
    {
        $this->getDictionary()->importLibrary($attributes['prefix']->getValue(), $attributes['url']->getValue());
    }
    
    public function startElement($tagName, $attributes, $closed, $source)
    {

        $parts = $this->splitTag($tagName);
        
        if ($parts['prefix'] == 'tpl' && $parts['name'] == 'taglib') {
            $this->processTagLib($attributes);
            return;
        }
        
        if ($parts['prefix'] == 'tpl' && $parts['name'] == 'strip') {
            $this->stripLevel++;
            return ;   
        }
        
        if ($parts['prefix'] == null || !$this->getDictionary()->hasLibrary($parts['prefix'])) {
            // This is html/xml tag. 
            $this->parseTextWithExpressions($source);
            return ;
        }
        
        $info = $this->getDictionary()->getLibrary($parts['prefix'])->getTagInfo($parts['name']);
        
        if ($info == null) {
            throw $this->createException("Tag '{$tagName}' is unknown");
        }

        $tag = $this->createTag($info->getClass(), $parts['prefix'],   $parts['name']);
        $tag->setTagInfo($info);
        $tag->addAttributes($attributes);   
        $tag->setLocation($this->fixLocation());
        
        $this->current->addChild($tag);
        
        if (!$closed && $info->isBodyLiteral()) {
            $this->getParser()->literalTag($tagName);
        }
        
        if (!$closed && !$info->isClosed()) {
            $this->current = $tag;
        }
        
        $this->lastNode = $tag;        
    }

    public function endElement($tagName, $source)
    {
        $parts = $this->splitTag($tagName);
        if ($parts['prefix'] === null || !$this->getDictionary()->hasLibrary($parts['prefix'])) {
            // This is html/xml tag. 
            $this->characters($source);
            return ;
        }
        
        if ($parts['prefix'] == 'tpl' && $parts['name'] == 'strip') {
            $this->stripLevel--;
            return ;   
        }
        
        $this->lastNode = null;
        $tag = strtolower($parts['name']);
        if (strtolower($this->current->getName()) != $tag) {
            throw $this->createException(
                "Invalid closing tag. '{$this->current->getName()}' wanted, but '{$tag}' founded. ",
                array('Founded' => $tag, 'Wanted' => $this->current->getName()));
        }
        
        $this->lastNode = $this->current;
        $this->current = $this->current->getParent();
    }
    
    protected function stripCharacters($characters) 
    {
        return preg_replace('~[\t ]*[\r\n]+[\t ]*~', '', $characters);
    }

    public function characters($characters)
    {
        if ($this->stripLevel > 0) {
            $characters = $this->stripCharacters($characters);
        }
        
        if (strlen($characters) == 0) {
            return ;
        }
        
        if ($this->lastNode instanceof Adept_Template_TextNode) { 
            $node = $this->executor->createTextNode($characters);
            $node->setLocation($this->fixLocation());
            $this->current->addChild($node);
            $this->lastNode = $node;
        } else {
            $this->lastNode->setText($this->lastNode->getText() . $characters);
        }
    }

    public function expression($expression)
    {
        $node = $this->executor->createExpressionNode($expression);
        $node->setLocation($this->fixLocation());
        $this->lastNode = $node;
        $this->current->addChild($node);
    }
    
    public function cdata($name, $content, $source)
    {
        if (strtolower($name) == 'literal') {
            // Literal block 
            $this->characters($content);
        } else {
            $this->characters($source);
        }
    }
    
    public function parseTextWithExpressions($source)
    {
        $source = $this->getParser()->removeComments($source);
        
        $pattern = '~\{([^\}]*)\}~';
        preg_match_all($pattern, $source, $matches);
        $expressions = $matches[1];
        $strings = preg_split($pattern, $source);
        
        if (count($expressions) == 0) {
            $this->characters($source);
            return ;
        }
        
        for ($i = 0; $i <= count($expressions); $i++) {
            if (strlen($strings[$i]) > 0) {
                $this->characters($strings[$i]);
            }
            if (isset($expressions[$i]) && strlen($expressions[$i]) > 0) {
                $this->expression($expressions[$i]);
            }
        }        
    }
    
    public function getRoot() 
    {
        return $this->root;
    }
    
    protected function createException($message, $parameters = array())
    {
        throw new Adept_Template_Exception($message, $parameters, $this->fixLocation());
    }
    
    protected function fixLocation()
    {
        return clone $this->getLocation();
    }
    
    protected function getLocation()
    {
        return $this->getParser()->getLocation();
    }
    
    /**
     * @return Adept_Template_Dictionary
     */
    public function getDictionary()
    {
        return $this->executor->getDictionary();
    }

    /**
     * @return Adept_Template_Parser
     */
    public function getParser()
    {
        if ($this->parser != null) {
            return $this->parser;
        }
        return $this->executor->getParser();
    }
    
    public function setParser($parser)
    {
        $this->parser = $parser;
    }
    
    
}