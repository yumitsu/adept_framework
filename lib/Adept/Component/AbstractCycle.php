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

abstract class Adept_Component_AbstractCycle extends Adept_Component_AbstractPersistent 
{

    /**
     * @var Iterator
     */
    protected $cycleIterator;
    
    /**
     * Create new instance cycle iterator.
     * 
     * @abstract 
     * @return Iterator
     */
    abstract protected function createCycleIterator();
    
    public function getCycleIterator()
    {
        if (null == $this->cycleIterator) {
            $this->cycleIterator = $this->createCycleIterator();
        }
        return $this->cycleIterator;
    }
    
    /**
     * @param array $children
     * @param Adept_Component_Cycle_CycleObserver $observer
     */
    public function iterate($children, $observer)
    {
        $iteration = 0;
        $this->cycleIterator = null;
        $iterator = $this->getCycleIterator();
        $iterator->rewind();
        if ($iterator->valid()) {
            do {
                $observer->beforeIterateChildren($iterator);
                foreach ($children as $child) {
                    $observer->iterateChild($iterator, $child, $iteration);
                }
                $observer->afterIterateChildren($iterator);
                $iteration++;
                $iterator->next();
            } while ($iterator->valid());
        } else {
            $observer->nothingToIterate($iterator);
        }
    }
    
    public function iterateChildren($observer)
    {
        $this->iterate($this->getChildren(), $observer);
    }
    
    public function iterateFacetsAndChildren($observer)
    {
        $this->iterate($this->getFacetsAndChildren(), $observer);
    }
    
    public function iterateFacet($facet, $observer)
    {
        $this->iterate($this->getFacet($facet), $observer);
    }

}
