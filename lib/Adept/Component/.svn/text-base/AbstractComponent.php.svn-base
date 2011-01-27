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

abstract class Adept_Component_AbstractComponent 
{

    // Bindings ---------------------------------------------------------------
    
    /**
     * Return the {@link Adept_Expression_Value} used to calculate value of specified
     * attribute or property name, if any.
     *
     * @param string $name Name of the attribute or property for which 
     * to retrieve a {@link Adept_Expression_Value}
     * 
     * @return Adept_Expression_Value 
     */
    abstract public function getValueExpression($name);
    
    /**
     * Set the {@link Adept_Expression_Value} for named attribute
     * or property.
     *
     * @param string $name
     * @param Adept_Expression_Value $expression
     */
    abstract public function setValueExpression($name, $expression);
    
    abstract public function getExpressionContext();
    
    abstract public function setExpressionContext($expressionContext);

    // Tree management --------------------------------------------------------
    
    abstract function getId();
    
    abstract function setId($id);
    
    /**
     * <p>Return the parent {@link Adept_Component_AbstractComponent} of this,
     * if any or null for root component.
     * 
     * @return Adept_Component_AbstractComponent
     */    
    abstract function getParent();
    
    abstract function setParent($parent);
    
    /**
     * Returns family of component if specified. Components family used for 
     * renderer search. If no renderer found used class name instead family.
     * 
     * @return string Components family name
     */
    abstract function getFamily();
    
    /**
     * Search parent component by class.  
     *
     * @param string $class Search component class name.
     * @return Adept_Component_AbstractComponent returns component of found 
     * or null if compomnent was not found.
     */
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
    
    abstract public function getClientId();
    
    abstract public function setClientId($clientId);
    
    abstract public function addChild($child);
    
    /**
     * @return Adept_List
     */
    abstract public function getChildren();
    
    abstract public function hasChildren();
    
    abstract public function hasFacets();
    
    public function hasChildrenOrFacets()
    {
        return $this->hasChildren() || $this->hasFacets();
    }
    
    /**
     * Search component by id property.
     *
     * @param string $id
     * @param boolean $recursive
     * @return Adept_Component_AbstractComponent Returns found component; null otherwise.
     */
    public function findChildById($id, $recursive = true)
    {
        foreach ($this->getChildren() as $child) {
            if ($child->getId() == $id) {
                return $child;
            }
            if ($recursive && $child->hasChildren()) {
                $result = $child->findChildById($id, true);
                if ($result != null) {
                    return $result;
                }
            }
        }
        return null;
    }
    
    /**
     * Find component by clientId property.
     *
     * @param string $clientId 
     * @param boolean $recursive Find in children if true
     * @return Adept_Component_AbstractComponent Component object if found; otherwise null
     */
    public function findChildByClientId($clientId, $recursive = true)
    {
        foreach ($this->getChildren() as $child) {
            if ($child->getClientId() == $clientId) {
                return $child;
            }
            if ($recursive && $child->hasChildren()) {
                $result = $child->findChildByClientId($clientId, true);
                if ($result != null) {
                    return $result;
                }
            }
        }
        return null;
    }
    
    public function findChildByClass($class, $recursive = true)
    {
        foreach ($this->getChildren() as $child) {
            if ($child instanceof $class) {
                return $child;
            }
            if ($recursive && $child->hasChildren()) {
                $result = $child->findChildByClass($class, true);
                if ($result != null) {
                    return $result;
                }
            }
        }
        return null;
    }
    
    public function findFacetsAndChildrenByClass($class, $recursive = true)
    {
    	$result = array();
        foreach ($this->getFacetsAndChildren() as $child) {
            if ($child instanceof $class) {
                $result[] = $child;
            }
            // TODO Think about it ;-)
            if ($recursive && $child->hasChildren()) {
                $result = array_merge($result, $child->findFacetsAndChildrenByClass($class, true));
            }
        }
        return $result;
    }

    public function findChildrenByClass($class, $recursive = true)
    {
        $result = array();
        foreach ($this->getChildren() as $child) {
            if ($child instanceof $class) {
                $result[] = $child;
            }
            // TODO Think about it ;-)
            if ($recursive && $child->hasChildren()) {
                $result = array_merge($result, $child->findChildrenByClass($class, true));
            }
        }
        return $result;
    }

    /**
     * Add facet to this component.
     *
     * @param string $name
     * @param Adept_Component_Facet $facet
     */
    abstract public function setFacet($name, $facet);
    
    /**
     * Returns facet by $name key.
     *
     * @param Adept_Component_Facet $name
     */
    abstract public function getFacet($name);
    
    /**
     * Returns merged factes and children collection.
     *
     * @return Adept_List Result collection.
     */
    public function getFacetsAndChildren()
    {
        $result = new Adept_List();
        foreach ($this->getFacets() as $facet) {
            $result->add($facet);
        }
        foreach ($this->getChildren() as $child) {
            $result->add($child);
        }
        return $result;
    }
    
    // Lifecycle phases -------------------------------------------------------
    
    abstract public function processInit();
    
    abstract public function processRestoreState();
    
    abstract public function processHandleRequest();
    
    abstract public function processValidation();
    
    abstract public function processUpdateModel();

    abstract public function processInvokeApplication();    
    
    abstract public function processSaveState();    
    
    abstract public function renderBegin();
    
    abstract public function renderChildren();

    abstract public function renderEnd();
    
    abstract public function renderAjax();
    
    final public function render()
    {
        $this->renderBegin();
        $this->renderChildren();
        $this->renderEnd();
    }

    // Redner management ------------------------------------------------------
    
    abstract public function isRendered();
    
    abstract public function setRendered($rendered);
    
    abstract public function getRendererType();
    
    abstract public function setRendererType($rendererType);
    
    // Attributes and client attributes ---------------------------------------

    abstract public function getAttribute($name, $defaultValue = null);
    
    abstract public function setAttribute($name, $value);
    
    // Events management ------------------------------------------------------

    abstract public function broadcast($event);
    
    abstract public function queueEvent($event);
    
    abstract public function addEventListener($eventName, $listener);
    
    abstract public function getEventListeners($eventName);
    
    abstract public function removeEventListeners($eventName);
    
    // Convenience methods ----------------------------------------------------
    
    abstract public function getContext();
    
    abstract public function getRenderer();
    
}