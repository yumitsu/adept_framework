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

class Adept_Template_Node 
{

    protected $refVar = null;
    
    protected $name;
    
    /**
     * @var Adept_Template_Executor
     */
    protected $executor;
    
    /**
     * @var Adept_List
     */
    protected $children;
    
    protected $nodeId = null;
    protected $parent = null;
    
    private static $nodeIdGenerator = 0;

    /**
     * @var Adept_Template_Location
     */
    protected $location;    
    
    public function __construct()
    {
        $this->name = "__node";
        $this->children = new Adept_List();
    }    
    
    // Preparations and generation ---------------------------------------------

    public function preParse($executor)
    {
        foreach ($this->children as $child) {
            $child->preParse($executor);
        }
    }
    
    public function prepare()
    {
        foreach ($this->children as $child) {
            $child->prepare();
        }
    }

    final public function generate($writer)
    {
        $this->generateBegin($writer);
        $this->generateChildren($writer);
        $this->generateEnd($writer);
    }

    public function generateBegin($writer)
    {
    }

    public function generateChildren($writer)
    {
        foreach ($this->children as $child) {
            $child->generate($writer);
        }
    }

    public function generateEnd($writer)
    {
    }    
    
    public function getElementRefCode()
    {
        return $this->getParent()->getElementRefCode(); 
    }    
    
    // Structure operations ----------------------------------------------------
    
    public function addChild($child)
    {
        $this->children->add($child);
        $child->setParent($this);
    }
    
    public function findChild($nodeId, $recursive = true)
    {
        foreach ($this->getChildren() as $child) {
            if ($child->getNodeId() == $nodeId) {
                return $child;
            } else {
                if (($result = $child->findChild($nodeId)) != null) {
                    return $result;
                }
            }
        }
        return null;
    }

    public function findChildByClass($class, $recursive = true)
    {
        foreach ($this->children as $child) {
            if ($child instanceof $class) {
                return $child;
            } elseif ($recursive) {
                $result = $child->findChildByClass($class);
                if (null !== $result) {
                    return $result;
                }
            }
        }
        return null;
    }

    public function findChildrenByClass($class, $recursive = true)
    {
        $result = array();
        foreach ($this->getChildren() as $child) {
            if ($child instanceof $class) {
                $result[] = $child;
            }
            if ($recursive) {
                $result = array_merge($result, $child->findChildrenByClass($class));
            }
        }
        return $result;
    }

    public function findParentByClass($class)
    {
        $parent = $this->getParent();
        while (!is_null($parent)) {
            if ($parent instanceof $class) {
                return $parent;
            }
            $parent = $parent->getParent();
        }
        return null;
    }

    public function hasChildren()
    {
        return ($this->children !== null) && ($this->children->count() > 0);
    }
    
    /**
     * @return Adept_List
     */
    public function getChildren()
    {
        return $this->children;
    }
    
    /**
     * Create template exception object.
     *
     * @param string $message
     * @param array $params
     * @return Adept_Template_Exception
     */
    public function createException($message, $params = array())
    {
        return new Adept_Template_Exception($message, $params, $this->getLocation());
    }
    
    // Properties --------------------------------------------------------------

    public function getExecutor() 
    {
        return $this->executor;
    }
    
    public function setExecutor($executor) 
    {
        $this->executor = $executor;
    }
    
    /**
     * @return Adept_Template_Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function getRoot()
    {
        return $this->parent->getRoot();
    }

    public function getNodeId()
    {
        if (!isset($this->nodeId)) {
            $this->nodeId = 'node' . self::$nodeIdGenerator++;
        }
        return $this->nodeId;
    }

    public function setNodeId($nodeId)
    {
        $this->nodeId = $nodeId;
    }
    
    public function getName() 
    {
        return $this->name;
    }
    
    public function setName($name) 
    {
        $this->name = $name;
    }
    
}
    