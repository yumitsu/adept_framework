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
 * @package    Adept_Model
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Model_TreeIterator implements Iterator 
{
    /**
     * @var Adept_Model_TreeItem
     */
    protected $root;
    protected $childIterator = null;
    protected $childIndex;
    protected $child;
    /**
     * @var ArrayIterator
     */
    protected $children;
    
    protected $current;
    protected $key;
    protected $level;
    protected $valid;
    
    protected $mode = array(
        'includeRootNode' => true,
        'rootNodeBefore' => true,
    );
    
    public function __construct($root)
    {
        if ($root instanceof Adept_Model_TreeItem) {
            $this->root = $root;
            $arrayObject = new ArrayObject($this->root->getChildren());
            $this->children = $arrayObject->getIterator();
        } else {
            throw new Adept_Exception_IllegalArgument();
        }
    }

    public function rewind()
    {
        $this->childIndex = 0;
        $this->key = -1;
        $this->level = 0;
        $this->valid = false;
        $this->child = $this->childrenRewind();
        if (($this->isIncludeRootNode() && $this->isRootNodeBefore()) || !$this->root->hasChildren()) {
            $this->updateFromRootNode();
            $this->key = 0;
        } elseif ($this->root->hasChildren()) {
            $this->level = 1;
            $this->next();
        }
    }
    
    public function next()
    {
        $this->key++;
        if ($this->childIterator !== null) {
            $this->childIterator->next();
            if ($this->childIterator->valid()) {
                $this->updateFromChildIterator();
            } else {
                $this->child = $this->childrenNext();
                $this->childIterator = null;
            }
        }
        if ($this->childIterator === null) {
            if ($this->children->valid()) {
                if ($this->child == null) {
                    echo get_class($this->root);
                }
                $this->childIterator = new Adept_Model_TreeIterator($this->child);
                $this->childIterator->setMode($this->getMode());
                $this->childIterator->rewind();
                if ($this->childIterator->valid()) {
                    $this->updateFromChildIterator();
                } else {
                    $this->key--;
                    $this->next();
                }
            } elseif ($this->isIncludeRootNode() && !$this->isRootNodeBefore()) {
                $this->updateFromRootNode();
            } else {
                $this->valid = false;
            }
        }
    }
    
    protected function updateFromChildIterator()
    {
        $this->level = 1;
        $this->current = $this->childIterator->current();
        $this->valid = true;
    }
    
    protected function updateFromRootNode()
    {
        $this->level = 0;
        $this->current = $this->root;
        $this->valid = true;
    }
    
    public function current()
    {
        return $this->current;
    }

    public function key()
    {
        return $this->key;
    }
    
    public function valid()
    {
        return $this->valid;
    }
    
    public function level()
    {
        $level = $this->level;
        if ($this->childIterator !== null && $this->childIterator->valid()) {
            $level += $this->childIterator->level();
        }
        return $level;
    }
    
    // Children operations
    
    protected function childrenRewind()
    {
        $this->children->rewind();
        if ($this->children->valid()) {
            return $this->children->current();
        }
        return null;
    }
    
    protected function childrenNext()
    {
        $this->children->next();
        if ($this->children->valid()) {
            return $this->children->current();
        }
        return null;
    }
    
    // Mode flags
    
    public function isIncludeRootNode() 
    {
        return $this->mode['includeRootNode'];
    }
    
    public function setIncludeRootNode($includeRootNode)
    {
        $this->mode['includeRootNode'] = $includeRootNode;
    }
    
    public function isRootNodeBefore() 
    {
        return $this->mode['rootNodeBefore'];
    }
    
//    public function setRootNodeBefore($rootNodeBefore)
//    {
//        $this->mode['rootNodeBefore'] = $rootNodeBefore;
//    }
    
    public function getMode()
    {
        return $this->mode;
    }
    
    public function setMode($mode)
    {
        $this->mode = $mode;
    }
}