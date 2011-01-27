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

class Adept_Filter_Dispatching extends Adept_Filter_Abstract
{

    protected $response;
    protected $request;
    protected $dispatchers;

    public function __construct()
    {
    }
    
    /**
     * Configurate filter
     *
     * @param Adept_Config $config
     */
    public function init($config)
    {
        $dispatchers = $config->getAsList('dispatcher');
        foreach ($dispatchers as $dispatcherConfig) {
            $class = $dispatcherConfig->get('class');
            $path = $dispatcherConfig->get('path');
            if ($class == null && $path == null) {
                throw new Adept_Exception('Dispatcher class or config path not defined');
            }
            if ($class !== null) {
                $dispatcher = new $class();
                $dispatcher->init($dispatcherConfig);
            } else {
                $dispatcher = new Adept_Dispatcher_ConfigBased();
                $dispatcher->init(Adept_ConfigLoader::getInstance()->load($path, array('combinedAttributes' => true)));
            }
            // Append dispatcher
            $this->add($dispatcher);
        }
    }

    public function process($chain)
    {
        $this->request = Adept_Context::getInstance()->getRequest();
        $this->response = Adept_Context::getInstance()->getResponse();

        $dispatchers = array();
        foreach($this->dispatchers as $dispatcher) {
            $dispatchers[] = new Adept_ClassKit_Delegate($dispatcher, 'dispatch');
        }
        $result = Adept_ClassKit_Delegate_List::invokeChain($dispatchers, array($this->request, $this->response));
        if ($result) {
            $chain->next();
        } else {
            throw new Adept_Exception_Error404('Request cannot be dispatched');
        }
    }

    public function add($dispatcher)
    {
        $this->dispatchers[] = $dispatcher;
    }

}
