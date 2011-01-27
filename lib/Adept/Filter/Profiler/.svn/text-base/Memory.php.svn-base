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
 * @package    Adept_Filter
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

/**
 * Adept memory usage profiler 
 */
class Adept_Filter_Profiler_Memory extends Adept_Filter_Abstract // implements Adept_Filter_IFilter
{

    protected $peakMemory = 0;
    protected $usedInClasses = 0;
    protected $classesLoaded = 0;

    protected $_before;
    protected $_inClass;

    /**
     * @internal Used as callback method
     * 
     * @param string $className Loading class
     */
    public function onBeforeLoad($className)
    {
        $this->classesLoaded++;
        if ($this->_inClass != null) {
            return;
        }
        $this->_inClass = $className;
        $this->_before = memory_get_usage();
    }

    /**
     * @internal Used as callback method
     * 
     * @param string $className Loaded class
     */
    public function onAfterLoad($className)
    {
        if ($this->_inClass == $className) {
            $this->usedInClasses += memory_get_usage() - $this->_before;
            $this->_inClass = null;
            if (memory_get_usage() > $this->peakMemory) {
                $this->peakMemory = memory_get_usage();
            }
        }
    }
    
    /**
     * @return Adept_ClassLoader
     */
    public function getClassLoader()
    {
        return Adept_ClassLoader::getInstance();
    }

    /**
     * Filter processing method. 
     * 
     * Add own callback on before/after class loading, @see Adept_ClassLoader
     * 
     * @param Adept_Filter_Chain $chain Filter chain instances
     */
    public function process($chain)
    {
        $this->getClassLoader()->addBeforeLoadListener(new Adept_ClassKit_Delegate($this, 'onBeforeLoad'));
        $this->getClassLoader()->addAfterLoadListener(new Adept_ClassKit_Delegate($this, 'onAfterLoad'));

        $chain->next();

        if (!Adept_Context::getInstance()->getRequest()->isAjax()) {
            echo '<small>' . __CLASS__ . '. Peak memory: <b>'
                .number_format($this->peakMemory / 1024, 0, ',',' ') . ' KBytes'
                .'</b>, used by PHP classes: <b>'
                .number_format($this->usedInClasses / 1024, 0, ',',' ') . ' KBytes'
                .'</b>, classes loaded: <b>'
                .$this->classesLoaded
                .'</b></small><br/>';
        }
    }

}
