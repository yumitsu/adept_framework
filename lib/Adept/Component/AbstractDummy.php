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
 * @package    Adept_Component
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

abstract class Adept_Component_AbstractDummy extends Adept_Component_AbstractComponent 
{

    protected $id;
    protected $parent = null;
    
    /**
     * @return null 
     */
    public function getValueExpression($name)
    {
        return null;
    }
    
    public function setValueExpression($name, $expression) 
    { 
    }
    
    public function getExpressionContext()
    {
        if ($this->getParent()) {
            return $this->getParent()->getExpressionContext();
        }
        return null;
    }
    
    public function setExpressionContext($expressionContext)
    {
        $this->expressionContext = $expressionContext;
    }

    // Tree management --------------------------------------------------------
    
    public function getId()
    {
        return $this->id;
    }    
    
    /**
     * Validate identifier syntax 
     *
     * @param string $id Identifier value
     * @return boolean
     */
    private function validateId($id)
    {
        return preg_match('~^(?:\w*)$~', $id);
    }   
    
    /**
     * Set component identifier of this {@link Adept_Component_AbstractBase}.
     *
     * @param string $id
     * @throws Adept_Exception_IllegalArgument If $id value is not valid.
     */
    public function setId($id)
    {
        if (!$this->validateId($id)) {
            throw new Adept_Exception_IllegalArgument('Invalid $id value');
        }
        
        $this->id = $id;
        $this->clientId = null;
    }    
    
    public function getParent()
    {
        return $this->parent;   
    }
    
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
    
    public function getFamily()
    {
    }
    
    public function getClientId()
    {
        return $this->getId();
    }
    
    public function setClientId($clientId)
    {
    }
    
    public function addChild($child)
    {
    }
    
    /**
     * @return Adept_List
     */
    public function getChildren()
    {
        return null;
    }
    
    public function hasChildren()
    {
        return false;
    }
    
    public function hasFacets()
    {
        return false;
    }
    
    /**
     * @param string $id
     * @param boolean $recursive
     * @return Adept_Component_AbstractComponent Returns found component; null otherwise.
     */
    public function findChildById($id, $recursive = true)
    {
        return null;
    }
    
    /**
     * @param string $clientId 
     * @param boolean $recursive Find in children if true
     * @return Adept_Component_AbstractComponent Component object if found; otherwise null
     */
    public function findChildByClientId($clientId, $recursive = true)
    {
        return null;
    }
    
    public function findChildByClass($class, $recursive = true)
    {
        return null;
    }
    
    public function findFacetsAndChildrenByClass($class, $recursive = true)
    {
        return array();
    }

    public function findChildrenByClass($class, $recursive = true)
    {
        return array();
    }

    public function setFacet($name, $facet)
    {
    }
    
    public function getFacet($name)
    {
        return null;
    }
    
    public function getFacetsAndChildren()
    {
        return new Adept_List();
    }
    
    // Lifecycle phases -------------------------------------------------------
    
    public function processInit()
    {
    }
    
    public function processRestoreState()
    {
    }
    
    public function processHandleRequest()
    {
    }
    
    public function processValidation()
    {
    }
    
    public function processUpdateModel()
    {
    }

    public function processInvokeApplication()
    {
    }
    
    public function processSaveState()
    {
    }
    
    public function renderBegin()
    {
    }
    
    public function renderChildren()
    {
    }

    public function renderEnd()
    {
    }
    
    public function renderAjax()
    {
    }

    // Redner management ------------------------------------------------------
    
    public function isRendered()
    {
        return true;
    }
    
    public function setRendered($rendered)
    {
    }
    
    public function getRendererType()
    {
        return null;
    }
    
    public function setRendererType($rendererType)
    {
    }
    
    // Attributes and client attributes ---------------------------------------

    public function getAttribute($name, $defaultValue = null)
    {
        return null;
    }
    
    public function setAttribute($name, $value)
    {
    }
    
    // Events management ------------------------------------------------------

    public function broadcast($event)
    {
    }
    
    public function queueEvent($event)
    {
    }
    
    public function addEventListener($eventName, $listener)
    {
    }
    
    public function getEventListeners($eventName)
    {
    }
    
    public function removeEventListeners($eventName)
    {
    }
    
    // Convenience methods ----------------------------------------------------
    
    /**
     * @return Adept_Context
     */
    public function getContext()
    {
        return Adept_Context::getInstance();
    }
    
    public function getRenderer()
    {
        return null;
    }
    
}