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

abstract class Adept_Component_AbstractBase extends Adept_Component_AbstractComponent 
    implements Adept_Component_PropertyTypesAndCaps, Adept_Component_Resource_JsRequired, Adept_Component_Resource_CssRequired   
{
    
//    /**
//     * Properties description map. Caseinsensitive.  
//     * 
//     * @var Adept_CanonicalMap
//     */
//    private $_propertiesMap;

    /**
     * @var Adept_Map
     */
    private $properties;

    /**
     * Client id dependent properties
     * 
     * @var Adept_Map
     */
    private $clientProperties = null;
    
    /**
     * Custom attributes 
     *
     * @var Adept_Map
     */
    protected $attributes = null;
    
    /**
     * @var Adept_Map
     */
    protected $bindings = null;
    
    /**
     * Component event listeners map. Map key equals to event name.
     * 
     * @var Adept_Map
     */
    protected $listeners = null;
    
    /**
     * Component family name. Equals to class name by default. 
     * @see Adept_Component_AbstractBase::getFamily()
     * 
     * @var string 
     */
    protected $family;
    
    protected $id;
    protected $clientId;
    
    protected $parent;
    
    protected $root;
    
    /**
     * @var Adept_Expression_Context
     */
    protected $expressionContext;
    
    /**
     * Children components
     * 
     * @var Adept_List
     */
    protected $children = null;
    
    /**
     * Facets map
     * 
     * @var Adept_Map
     */
    protected $facets = null;    
    
    // Client attributes: dirtyState 
    
    protected $renderDependencies = null;
    
    // Constructor ------------------------------------------------------------
    
    public function __construct()
    {
        // Define properties metadata
        if (!$this->getPropertiesRegistry()->isClassExists(get_class($this))) {
            $this->defineProperties();
        }
    }
    
    public function __wakeup() 
    {
        if (!$this->getPropertiesRegistry()->isClassExists(get_class($this))) {
            $this->defineProperties();
        }
    }
    
    // Persistent---------------------------------------------------------------
    
    public function isPersistent()
    {
        if ($this->getProperty("persistent") === null) {
            return $this->getRootView()->isPersistent();
        }
        return $this->getProperty("persistent");
    }
    
    public function setPersistent($persistent)
    {
        $this->setProperty("persistent", $persistent);
    }

    // Properties defintion ----------------------------------------------------
        
    /**
     * @return Adept_Component_PropertiesRegistry
     */
    protected function getPropertiesRegistry()
    {
        return Adept_Component_PropertiesRegistry::getInstance();
    }
    
    protected function addPropertyDescription($name,  
        $capabilities = array(), $default = null, $type = self::TYPE_MIXED)
    {    
        return $this->getPropertiesRegistry()->addPropertyDescription(get_class($this),
            $name, $capabilities, $default, $type);
    }
    
    protected function setPropertyDefaultValue($name, $defaultValue)
    {
        $property = $this->getPropertiesRegistry()->getPropertyDescription(get_class($this), $name);
        if ($property == null) {
            throw new Adept_Exception_NullPointer('Property is not exists');
        }
        $property->setDefault($defaultValue);
    }
    
    /**
     * @return Adept_Map
     */
    protected function getProperyDecriptions()
    {
        return $this->getPropertiesRegistry()->getProperyDecriptions(get_class($this));
    }
    
    /**
     * Add property with empty capabilities.
     *
     * @param string $name Property name
     * @return Adept_Component_PropertyDescription
     */
    protected function addDefaultPropertyDescription($name)
    {
        return $this->addPropertyDescription($name, array(), null, self::TYPE_MIXED);
    }
    
    /**
     * Returns property definition structure.
     *
     * @param string $name Property name.
     * @return Adept_Component_PropertyDescription
     */
    protected function getPropertyDescription($name)
    {
        return $this->getPropertiesRegistry()->getPropertyDescription(get_class($this), $name);
    }
    
    /**
     * Component property definition.
     * 
     * You should call this method in child class if overried.
     * 
     * @return void  
     */
    protected function defineProperties()
    {
        $this->addPropertyDescription('this', array());
        $this->addPropertyDescription('rendered', array(), true, self::TYPE_BOOL);
        $this->addPropertyDescription('rendererClass', array());
        $this->addPropertyDescription('rendererType', array());
        $this->addPropertyDescription('forceClientId', array(), false, self::TYPE_BOOL);
        $this->addPropertyDescription('persistent', array(), null);
        $this->addPropertyDescription('dirtyState', array(self::CAP_CLIENT), Adept_Component_DirtyState::NOTHING);
    }
    
    // 
    
    // Resource ---------------------------------------------------------------
    
    public function getRequiredJs()
    {
        
        if ($this->hasRenderer()) {
            
            return $this->getRenderer()->getRequiredJs($this);
        }
        return array();
    }
    
    public function getRequiredCss()
    {
        if ($this->hasRenderer()) {
            return $this->getRenderer()->getRequiredCss($this);
        }
        return array();
    }
    
    // Expressions -------------------------------------------------------------
    
    public function hasValueExpression($name)
    {
        $name = strtolower($name);
        if ($this->bindings === null) {
            return false;
        }
        return $this->bindings->has($name);
    }
    
    /**
     * Returns value expression of named binding
     *
     * @param string $name
     * @return Adept_Expression_Evaluable
     */
    public function getValueExpression($name)
    {
        $name = strtolower($name);
        if ($this->bindings === null) {
            $this->bindings = new Adept_CanonicalMap();
        } 
        $expr = $this->bindings->get($name);
        if ($expr instanceof Adept_Expression_Evaluable) {
            return $expr;   
        } else {
            return null;
        }
    }
    
    /**
     * Set value expression of named binding.
     * 
     * @param string $name Binding name.
     * @param Adept_Expression_Evaluable|string $expression Expression object or string.
     * @param bool $native Set true if $expression is prepeared native php string.
     */    
    public function setValueExpression($name, $expression, $native = false)
    {
        $name = strtolower($name);
        
        if ($name == 'id' || $name == 'parent') {
            throw new Adept_Exception_IllegalArgument('Cannot set expression for id or parent property');
        }
        
        if (is_string($expression)) {
            if ($native) {
                $expression = Adept_Expression_Factory::getInstance()->createNativeExpression($expression);
            } else {
                $expression = Adept_Expression_Factory::getInstance()->createExpression($expression);    
            }
        }
        
        if (!$expression instanceof Adept_Expression_Evaluable) {
            throw new Adept_Exception_IllegalArgument('$expression is not Evaluable');
        }
        
        // TODO Optional flag
        if (Adept_Debug::getFlag(Adept_Debug::EXPRESSION_EVAL_ERRORS) && $expression instanceof Adept_Expression_NativePhp) {
            $expression->setLocation($this->getAttribute('_file'), $this->getAttribute('_line'));
        }
        
        if ($this->bindings == null) {
            $this->bindings = new Adept_Map();
        }
        if ($expression !== null) {
            $this->bindings->set($name, $expression);
        } else {
            $this->bindings->remove($name);
            if ($this->bindings->isEmpty()) {
                $this->bindings = null;
            }
        }
    }
    
    /**
     * @return Adept_Exression_Context
     */
    public function getExpressionContext()
    {
        if (null == $this->expressionContext) {
            $parent = $this->getParent();
            if (null != $parent) {
                $this->expressionContext = $parent->getExpressionContext();
            }
        }
        
        if (null == $this->expressionContext) {
            throw new Adept_Exception_IllegalState('Cannot receive ExpressionContext');
        }
        
        return $this->expressionContext;
    }
    
    public function setExpressionContext($expressionContext)
    {
        $this->expressionContext = $expressionContext;
    }
    
    // Properties and bindings helpers ----------------------------------------

    protected function getProperty($name, $defaultValue = null)
    {
        $description = $this->getPropertyDescription($name);
        if ($description == null) {
            // TODO Should we do it?
            return $this->_getProperty($name, $defaultValue); 
            //$description = $this->addDefaultPropertyDescription($name);
        } 
        if ($description->isClient()) {
            return $this->_getClientProperty($name, $description->getDefault());
        } else {
            return $this->_getProperty($name, $description->getDefault());
        }
    }
    
    protected function getLocalProperty($name)
    {
        if ($this->properties == null) {
            return null;
        }
        $description = $this->getPropertyDescription($name);
        if ($description == null) {
            return null;
        }
        if (!$description->isClient()) {
            return $this->properties->get($name);
        } 
        return null;
    }
    
    protected function setProperty($name, $value)
    {
        $description = $this->getPropertyDescription($name);
        if ($description == null) {
            throw new Adept_Exception("Undefined property '{$name}' of " . get_class($this) . " component ");
            // TODO Exception in future or Default property type ??
            $this->_setProperty($name, $value);
            return ;    
        } 
        if ($description->isClient()) {
            $this->_setClientProperty($name, $value);
        } else {
            $this->_setProperty($name, $value);
        }
    }    
    
    protected function resetProperty($name)
    {
        $description = $this->getPropertyDescription($name);
        if ($description == null) {
            // TODO Exception in future or Default property type ??
            $this->_resetProperty($name, $value);
            return ;    
        } 
        if ($description->isClient()) {
            // TODO reset client property
        } else {
            $this->_resetProperty($name);
        }
    }  

    protected function hasProperty($name)
    {
        return $this->getPropertyDescription($name) !== null;
    }      
    
    private function _getProperty($name, $defaultValue = null)
    {
        if ($this->properties instanceof Adept_Map && $this->properties->has($name)) {
            return $this->properties->get($name);
        } else {
            $expr = $this->getValueExpression($name);
            if (null !== $expr) {
                return $expr->getValue($this->getExpressionContext());
            } 
            return $defaultValue;
        }
    }
    
    private function _setProperty($name, $value)
    {
        if ($value instanceof Adept_Expression_Evaluable) {
            $this->resetProperty($name);
            $this->setValueExpression($name, $value);
            return ;
        } 
        if ($this->properties === null) {
            $this->properties = new Adept_CanonicalMap();
        }
        $this->properties->set($name, $value);
    }
    
    protected function _resetProperty($name)
    {
        if ($this->properties instanceof Adept_Map) {
            $this->properties->remove($name);
        }
        $this->setValueExpression($name, null);
    }    
    
    protected function _getClientProperty($name, $defaultValue = null)
    {
        if ($this->clientProperties === null) {
            return $defaultValue;
        }
        $clientId = $this->getClientId();
        if ($this->clientProperties->has($clientId)) {
            $clientProperties = $this->clientProperties->get($clientId);
            return $clientProperties->has($name) ? $clientProperties->get($name) : $defaultValue;
        } else {
            return $defaultValue;
        }
    }
    
    protected function _setClientProperty($name, $value)
    {
        if ($this->clientProperties === null) {
            $this->clientProperties = new Adept_CanonicalMap();
        }
        
        $clientId = $this->getClientId();
        
        $clientProperties = $this->clientProperties->get($clientId);
        if ($clientProperties === null) {
            $clientProperties = new Adept_CanonicalMap();
            $this->clientProperties->set($clientId, $clientProperties);
        }
        $clientProperties->set($name, $value);
    }

    /**
     * Returns value binding with $name id and null if nothing defined.
     *
     * @param string $name Name of value binding property.
     * @return Adept_Expression_ValueBinding
     */
    protected function getValueBinding($name)
    {
        $binding = $this->getProperty($name);
        
        if (is_string($binding)) {
            $binding = Adept_Expression_Factory::getInstance()->createValueBinding($binding);
        }
        
        if (!($binding instanceof Adept_Expression_ValueBinding)) {
            return null;
        } 
        
        return $binding;
    }
    
    /**
     * Returns method binding with $name id and null if nothing defined.
     *
     * @param string $name Name of value binding property.
     * @return Adept_Expression_MethodBinding
     */
    protected function getMethodBinding($name)
    {
        $binding = $this->getProperty($name);
        
        if (is_string($binding)) {
            $binding = Adept_Expression_Factory::getInstance()->createMethodBinding($binding);
        }

        if (!($binding instanceof Adept_Expression_MethodBinding)) {
            return null;
        }
        
        return $binding;
    }
    
    public function getAttribute($name, $defaultValue = null)
    {
        if ($this->attributes == null) {
            return $defaultValue;
        }        
        return $this->attributes->has($name) ? $this->attributes->get($name) : $defaultValue;
    }
    
    public function setAttribute($name, $value)
    {
        if ($this->attributes == null) {
            $this->attributes = new Adept_Map();
        }
        $this->attributes->set($name, $value);
    }

    // Tree management --------------------------------------------------------
    
    protected function generateId($object = null)
    {
        return $this->getParent()->generateId($object == null ? $this : $object);
    }
    
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
    
    /**
     * @return Adept_Component_AbstractComponent
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * @todo Realize correct branch moving 
     *
     * @param Adept_Component_AbstractComponent $parent
     */
    public function setParent($parent)
    {
//        if (null !== $this->parent && $parent !== $this->parent) {
//            // Component moved from one parent node to another. 
//        }
        $this->parent = $parent;
    }
    
    /**
     * Returns family of component if specified. Components family used for 
     * renderer search. If no renderer found used class name instead family.
     * 
     * @return string Components family name
     */
    public function getFamily()
    {
        if ($this->family === null) {
            $this->family = get_class($this);
        }
        return $this->family;
    }
    
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
    
    public function getClientId()
    {
        $clientId = $this->clientId;

        if ($clientId === null) {
            $exp = $this->getValueExpression('clientId');
            if ($exp !== null) {
                $clientId = $exp->getValue($this->getExpressionContext());
            }
        }
        
        if ($clientId == null) {
            $clientId = $this->getId();
        }
        
        if ($this->isForceClientId()) {
            return $clientId;
        }
        
        $container = $this->getNamingContainer();
        
        if ($container != null) {
            $prefix = $container->getNamingContainerId();
            if ($prefix != null) {
                return $prefix . Adept_Component_NamingContainer::SEPARATOR . $clientId;
            } else {
               return $clientId;
            }
        } else {
            return $clientId;
        }
    }
    
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }
    
    public function isForceClientId() 
    {
        return $this->getProperty('forceClientId', false);
    }
    
    public function setForceClientId($forceClientId)
    {
        $this->setProperty('forceClientId', $forceClientId);
    }
    
    /**
     * Finds NamingContainer in parents of this component. 
     *
     * @return Adept_Component_NamingContainer Found component; null otherwise.
     */
    public function getNamingContainer()
    {
        return $this->findParentByClass('Adept_Component_NamingContainer');
    }
    
    /**
     * Returns "$this" component binding string.
     *
     * @return string
     */
    public function getThis()
    {
        return $this->getProperty('this');
    }
    
    public function setThis($thisValue)
    {
        $this->setProperty('this', $thisValue);
    }
    
    // Children and factes ----------------------------------------------------
    
    /**
     * Add component to children list.
     *
     * @param Adept_Component_AbstractBase $child
     */
    public function addChild($child)
    {
        $child->setParent($this);
        $this->getChildren()->add($child);
    }
    
    /**
     * Returns children collection.
     * 
     * @return Adept_List
     */
    public function getChildren()
    {
        if ($this->children == null) {
            $this->children = new Adept_List();
        }
        return $this->children;
    }
    
    /**
     * Return true is component has children.
     *
     * @return boolean
     */
    public function hasChildren()
    {
        return ($this->children !== null && $this->children->count() > 0);
    }
    
    /**
     * Return true is component has facets.
     *
     * @return boolean
     */
    public function hasFacets()
    {
        return ($this->facets !== null && $this->facets->count() > 0);
    }
    
    /**
     * Add new facet to this component.
     *
     * @param string $name
     * @param Adept_Component_Facet $facet
     */
    public function setFacet($name, $facet)
    {
        $facet->setParent($this);
        $this->getFacets()->set($name, $facet);
    }
    
    /**
     * Returns facet by $name key.
     *
     * @param Adept_Component_Facet $name
     */
    public function getFacet($name)
    {
        return $this->getFacets()->get($name);        
    }

    /**
     * Returns facets map. 
     * 
     * @return Adept_Map Facets of this component.
     */
    public function getFacets()
    {
        if ($this->facets == null) {
            $this->facets = new Adept_Map(); 
        }
        return $this->facets;
    }
    
    // Lifecycle phases ----------------------------------------------------------
    
    public function init()
    { }
    
    /**
     * Setup binded property to $this, if binding exists.
     *
     * @return void
     */
    protected function updateThis()
    {
        $binding = $this->getValueBinding('this');
        if (null !== $binding) {
            $binding->setValue($this->getExpressionContext(), $this);
        }
    }
    
    public function processInit()
    {
        $this->init();
        
        if ($this->hasChildrenOrFacets()) {
            foreach ($this->getFacetsAndChildren() as $component) {
                $component->processInit();
            }
        }
    }
    
    public function processRestoreState()
    {
        $this->updateThis();
        
        if ($this->hasChildrenOrFacets()) {
            foreach ($this->getFacetsAndChildren() as $component) {
                $component->processRestoreState();
            }
        }
    }
    
    /**
     * Handle request method. Delegates handleRequest routine to Renderer if 
     * $rendererType property not null.
     * 
     * @return void
     * @throws Adept_Exception If renderer not found but $rendererType not null
     */
    public function handleRequest()
    {
        if ($this->hasRenderer()) {
            $renderer = $this->getRenderer();
            if ($renderer == null) {
                throw new Adept_Exception('Renderer not found');
            }
            $renderer->handleRequest($this);
        }
    }
    
    public function processHandleRequest()
    {
        
        $this->handleRequest();
        
        if ($this->hasChildrenOrFacets()) {
            foreach ($this->getFacetsAndChildren() as $component) {
                $component->processHandleRequest();
            }        
        }
    }
    
    public function validate()
    {
    }
    
    public function processValidation()
    {
        $this->validate();
        if ($this->hasChildrenOrFacets()) {
            foreach ($this->getFacetsAndChildren() as $component) {
                $component->processValidation();
            }
        }
    }
    
    public function updateModel()
    {
    }
    
    public function processUpdateModel()
    {
        
        $this->updateModel();
        foreach ($this->getFacetsAndChildren() as $component) {
            $component->processUpdateModel();
        }
    }
    
    public function invokeApplication()
    {
    }

    public function processInvokeApplication()
    {
        $this->invokeApplication();
        
        if ($this->hasChildrenOrFacets()) {
            foreach ($this->getFacetsAndChildren() as $component) {
                $component->processInvokeApplication();
            }
        }
    }
    
    public function processSaveState()
    {
        if ($this->hasChildrenOrFacets()) {
            foreach ($this->getFacetsAndChildren() as $component) {
                $component->processSaveState();
            }
        }
    }
    
    /**
     * Returns true if compoent has renderer or false if component renderes himself. 
     * Always return true, but could be override. 
     * 
     * @return bool 
     */
    public function hasRenderer()
    {
        return true;
    }
    
    public function renderBegin()
    {
        if (!$this->hasRenderer() || !$this->isRendered()) {
            return ;
        }
        $renderer = $this->getRenderer();
        if ($renderer != null) {
            $renderer->renderBegin($this);
        }
    }
    
    public function renderChildren()
    {
        if (!$this->isRendered()) {
            return ;
        }        
        $renderer = $this->getRenderer();
        if ($renderer != null) {
            $renderer->renderChildren($this);
        } else {
            foreach ($this->getChildren() as $component) {
                $component->render();
            }
        }
    }
    
    public function renderEnd()
    {
        if (!$this->hasRenderer() || !$this->isRendered()) {
            return ;
        }    
        $renderer = $this->getRenderer();
        if ($renderer != null) {
            $renderer->renderEnd($this);
        }           
    }    
    
    final public function invokePhase($phaseId)
    {
        switch ($phaseId) {
            case Adept_Lifecycle_PhaseId::INIT:
                $this->processInit();
                break;
            case Adept_Lifecycle_PhaseId::HANDLE_REQUEST:
                $this->processHandleRequest();
                break;
            case Adept_Lifecycle_PhaseId::VALIDATION:
                $this->processValidation();
                break;
            case Adept_Lifecycle_PhaseId::UPDATE_MODEL:
                $this->processUpdateModel();
                break;
            case Adept_Lifecycle_PhaseId::INVOKE_APPLICATION:
                $this->processInvokeApplication();
                break;
            case Adept_Lifecycle_PhaseId::SAVE_STATE:
                $this->processSaveState();
                break;
            case Adept_Lifecycle_PhaseId::RENDER:
                $this->render();
                break;
            case Adept_Lifecycle_PhaseId::RENDER_AJAX:
                $this->renderAjax();
                break;
            default:
                throw new Adept_Exception_IllegalArgument('$phaseId contains invalid ID');        
        }
    }
    
    // Redner management ------------------------------------------------------
    
    public function isRendered()
    {
        return $this->getProperty('rendered', true);
    }
    
    public function setRendered($rendered)
    {
        $this->setProperty('rendered', $rendered);
    }
    
    public function show()
    {
        $this->setRendered(true);
    }
    
    public function hide()
    {
        $this->setRendered(false);
    }

    public function getRendererClass()
    {
        return $this->getProperty('rendererClass');
    }
    
    public function setRendererClass($rendererClass)
    {
        $this->setProperty('rendererClass', $rendererClass);
    }
    
    public function getRendererType()
    {
        return $this->getProperty('rendererType');
    }
    
    public function setRendererType($rendererType)
    {
        $this->setProperty('rendererType', $rendererType);
    }   
    
    // Attributes and client attributes ---------------------------------------
    
    /**
     * Returns attributes map. 
     * 
     * @return Adept_Map 
     */
    public function getAttributes()
    {
        if ($this->attributes === null) {
            $this->attributes = new Adept_Map();
        }
        return $this->attributes;
    }
    
    // Events management ------------------------------------------------------

    /**
     * Broadcasts $event to registered listeners.
     *
     * @param Adept_Event_Abstract $event
     */
    public function broadcast($event)
    {
        $listeners = $this->getEventListeners($event->getName());
            
        if (count($listeners) == 0) {
            return ;
        }
        foreach ($listeners as $listener) {
            $result = $listener->invoke($this->getExpressionContext(), array($event));
            // Break chain if something returned
            if (null != $result) {
                break;
            }
        }
    }
    
    public function queueEvent($event)
    {
        if (!$event instanceof Adept_Event_Abstract) {
            throw new Adept_Exception_IllegalArgument();
        }
        
        $parent = $this->getParent();
        if ($parent == null) {
            throw new Adept_Exception_IllegalState();
        }
        // Popup event
        $parent->queueEvent($event);
    }
    
    /**
     * Add listener for event named $eventName.
     *
     * Example,
     * <pre>
     * class ListenerObject 
     * {
     *     public function onClick(Adept_Event_Click $event) 
     *     {
     *          // Button clicked
     *          $event->getSender()->hide(); // Hide clicked button
     *     }
     * }
     * 
     * $listenerObject = new ListenerObject();
     * $button->addEventListerner('click', new Adept_ClassKit_Delegate($listenerObject, 'onClick'));
     * </pre>
     * 
     * @param string $eventName
     * @param Adept_Expression_Invokable|Adept_ClassKit_Delegate_Iterface $listener
     */
    public function addEventListener($eventName, $listener)
    {
        // Wrap delegate
        if ($listener instanceof Adept_ClassKit_Delegate_Interface) {
            $listener = new Adept_Expression_DelegateAdapter($listener);
        }
        
        if ($this->listeners == null) {
            $this->listeners = new Adept_Map();
        }
        if ($this->listeners->has($eventName)) {
            $this->listeners->get($eventName)->add($listener); 
        } else {
            $list = new Adept_List(array($listener));
            $this->listeners->set($eventName, $list);
        }
    }
    
    public function addListenerBinding($event, $binding)
    {
        $this->addEventListener($event, Adept_Expression_Factory::getInstance()->createMethodBinding($binding));
    }
    
    /**
     * Returns map of $eventName event listeners.
     *
     * @param string $eventName
     * @return Adept_List 
     */
    public function getEventListeners($eventName)
    {
        if ($this->listeners == null) {
            $this->listeners = new Adept_Map();
        }
        if ($this->listeners->has($eventName)) {
            return $this->listeners->get($eventName);
        } else {
            return new Adept_List();
        }
    }
    
    /**
     * Remove event listeners of event named $eventName.
     *
     * @param string $eventName
     * @return boolean True if something removed; false otherwise.
     */
    public function removeEventListeners($eventName)
    {
        if ($this->listeners != null) {
            if ($this->listeners->has($eventName)) {
                $this->listeners->remove($eventName);
                if ($this->listeners->isEmpty()) {
                    $this->listeners = null;
                }
                return true;
            }
        }
        return false;
    }
    
    // AJAX Features ----------------------------------------------------------
    
    public function findDirtyComponents()
    {
        $result = array();
        foreach ($this->getChildren() as $component) {
            if ($component->getDirtyState() != Adept_Component_DirtyState::NOTHING) {
                $result[] = $component;
            }
            if ($component) {
                $result = array_merge($result, $component->findDirtyComponents());
            }
        }
        return $result;
    }
    
    public function getDirtyState()
    {
        return $this->getProperty('dirtyState');
    }
    
    public function setDirtyState($dirtyState)
    {
        $this->setProperty('dirtyState', $dirtyState);
    }
    
    /**
     * Returns render dependecies map. Key equals clientId property of dependent
     * component, value equals to {@link Adept_Component_DirtyState}.
     *
     * @return Adept_Map
     */
    public function getRenderDependencies() 
    {
        if ($this->renderDependencies == null) {
            $this->renderDependencies = new Adept_Map();
        }
        return $this->renderDependencies;
    }
    
    public function setRenderDependencies($renderDependencies) 
    {
        $this->renderDependencies = $renderDependencies;
    }
    
    public function markDirty($state = Adept_Component_DirtyState::FULLY, 
                              $dependenceState = Adept_Component_DirtyState::FULLY)
    {
        if ($this instanceof Adept_Component_DomContainer) {
            $this->setDirtyState($state);
        } else {
            $this->getParent()->markDirty($state, $dependenceState);
        }
    }
    
    public function renderAjax()
    {
        if (!$this->isRendered()) {
            return ;
        }    
        
        if ($this instanceof Adept_Component_DomContainer 
            && Adept_Component_DirtyState::NOTHING !== $this->getDirtyState()) {
            // If this node if DomContainer and dirty then capture output for 
            // this branch and send via Ajax channel.
            
            $childrenOnly = $this->getDirtyState() == Adept_Component_DirtyState::CHILDREN;
            $response = $this->getContext()->getResponse();
            
            $buffer = $response->startCapture();
            if ($childrenOnly) {
                $this->renderChildren();
            } else {
                $this->render();
            }
            $content = $response->endCapture()->getContent();

            if ($childrenOnly) {
                $this->getContext()->getAjaxChannel()->update($this->getDomContainerId(), $content);
            } else {
                $this->getContext()->getAjaxChannel()->replace($this->getDomContainerId(), $content);
            }
        } else {
            // Go down recursively.
            foreach ($this->getChildren() as $child) {
                $child->renderAjax();
            }
        }
        
    }
    
    // Convenience methods ----------------------------------------------------
    
    /**
     * Returns current {@link Adept_Context} instance.
     *
     * @return Adept_Context
     */
    public function getContext()
    {
        return Adept_Context::getInstance();
    }
    
    /**
     * Returns root component.
     * 
     * @return Adept_Component_RootView
     */
    public function getRootView()
    {
        return $this->getContext()->getRootView();
    }
    
    /**
     * Returns view actually for this component.
     *
     * @return Adept_Component_AbstractView
     */
    public function getView()
    {
        return $this->getParent()->getView();
    }
    
    /**
     * Returns Adept_Response_Writer instance.
     *
     * @return Adept_Response_Writer 
     */
    public function getResponseWriter()
    {
        return $this->getContext()->getResponseWriter();
    }
    
    public function getDefaultRendererType()
    {
    	return null;
    }
    
    /**
     * Returns renderer for component if possible; null otherwise. 
     * 
     * @return Adept_Renderer_Abstract
     * 
     * @throws Adept_Exception_IllegalState If component has renderer but not found
     */
    public function getRenderer()
    {
        if (!$this->hasRenderer()) {
            return null;
        }
        
        $rendererType = $this->getRendererType();
        
        if ($rendererType == null) {
            $rendererType = $this->getDefaultRendererType();
        }
        
        $renderer = $this->getContext()->getRenderKit()->resolveRenderer($this->getFamily(), $rendererType);

        if ($renderer == null) {
            throw new Adept_Exception_IllegalState('Renderer not defined');
        }
        //echo $rendererType . ' ' . get_class($this) . '<br/>';
        return $renderer;
    }
    
    /**
     * @return Adept_Logger
     */
    public function getLogger()
    {
        return Adept_Logger::getLogger(get_class($this) . '#' . $this->getClientId());
    }
    
    public function isLogged($logType)
    {
        return $this->getLogger()->isLoggedType($logType);
    }
    
    // Magic property access --------------------------------------------------
    
    public function get($name)
    {
        $getter = 'get' . ucfirst($name);
        
        if (!method_exists($this, $getter)) {
            $getter = 'is' . $name;
            if (!method_exists($this, $getter)) {
                throw new Adept_Exception("Cannot get property '{$name}' value");
            }
        }
        return $this->$getter();
    }
    
    public function set($name, $value)
    {
        $setter = 'set' . ucfirst($name);
        if (!method_exists($this, $setter)) {
            throw new Adept_Exception("Cannot set property '{$name}' value");
        }
        return $this->$setter($value);
    }
    
}

