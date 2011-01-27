<?php

class Adept_CollectionDecorator implements Adept_Collection
{
    
    /**
     * @var Adept_Collection
     */
    protected $collection;
    
    protected $decorators = array();
    
    /**
     * @var array
     */
    protected $decorated = array(); 
    
    /**
     * @param Adept_Collection $collection
     */
    public function __construct($collection, $decorators = array())
    {
        $this->collection = $collection;
        
        if ($decorators) {
            if (is_array($decorators)) {
                $this->decorators = $decorators;
            } else {
                $this->decorators[] = $decorators;
            }
        }
    }
    
    public function addDecorator($class)
    {
        $this->decorators[] = $class;
    }    
    
    /**
     * @param mixed $object
     */
    protected function _decorate($object)
    {
        $wrapper = $object;
        foreach ($this->decorators as $decoratorClass) {
            $wrapper = Adept_ClassKit_Util::createObject($decoratorClass, array($wrapper));
        }
        return $wrapper;
    }
    
    public function add($item)
    {
        $this->collection->add($item);
    }
    
    public function get($index)
    {
        if (!isset($this->decorated[$index])) {
            $value = $this->collection->get($index);
            if (is_object($value)) {
                $value = $this->_decorate($value);
                $this->decorated[$index] = $value;
            } 
        } else {
            $value = $this->decorated[$index];
        }
        return $value;
    }
    
    public function set($index, $value)
    {
        $this->collection->set($index, $value);
        unset($this->decorated[$index]); 
    }
    
    public function merge($collection)
    {
        $this->collection->merge($collection);
    }
    
    public function indexOf($object)
    {
        return $this->collection->indexOf($object);
    }
    
    public function contains($object)
    {
        return $this->collection->contains($object);    
    }
    
    public function isEmpty()
    {
        return $this->collection->isEmpty();
    }
    
    public function toArray()
    {
        return $this->collection->toArray();
    }
    
    public function remove($key) 
    {
        $this->collection->remove($key);
        unset($this->decorated[$key]);   
    }
    
    public function removeAll()
    {
        $this->collection->removeAll();
        $this->decorated = array();
    }
    
    public function count()
    {
    	return count($this->collection);
    }
    
    public function getIterator()
    {
        $iterator = $this->collection->getIterator();
        $iterator->setCollection($this);
        return $iterator;
    }
    
    
    
}

