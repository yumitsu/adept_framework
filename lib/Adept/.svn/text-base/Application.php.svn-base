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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

/**
 * Application base class
 * 
 * For runing your application you should write something like this: 
 * <pre>
 * $app = new Adept_Application();
 * $app->registerFilter(new MyFilter_ApplicationLogic());
 * $app->run();
 * </pre> 
 * 
 */
class Adept_Application
{

    /**
     * Application config
     *
     * @var Adept_Config
     */
    protected $config = null;

    /**
     * @var Adept_Context
     */
    protected $context;
    
    /**
     * Application data encoding
     * 
     * @var string
     */
    protected $encoding = 'UTF-8';
    
    /**
     * @var Adept_Filter_Chain
     */
    protected $filterChain;
    
    protected $redirectCount = 0;

    // Constructor ------------------------------------------------------------
    
    /**
     * Constructor.
     *
     * @param Adept_Config|string $config Application config if any; otherwise null.
     */
    public function __construct($configOrPath = null, $options = array())
    {
        if (is_string($configOrPath)) {
            $this->config = Adept_ConfigLoader::getInstance()->load($configOrPath, $options);
        } elseif ($configOrPath instanceof Adept_Config) {
            $this->config = $configOrPath;
        } elseif (null !== $configOrPath) {
            throw new Adept_Exception_IllegalArgument();
        }
        
        $this->setFilterChain(new Adept_Filter_Chain());
    }
    
    public function init()
    {
        $this->initApplication();
        $this->initContext();
        $this->initFilters();
        $this->initRenderKits();
    }
    
    public function initApplication()
    {
        if (null != $this->config) {
            $this->setEncoding($this->config->get('encoding'));
        } else {
            $this->setEncoding('CP1251');
        }
    }
    
    public function initContext()
    {
        $context = Adept_Context::getInstance();
        $context->setApplication($this);
        $context->setRequest(new Adept_Request_Http());
        $context->setResponse(new Adept_Response_Http());
        $context->setSession(new Adept_Session_Http());
        
        $context->setResponseWriter(new Adept_Response_Writer($context->getResponse()));
        $this->setContext($context);
    }
    
    /**
     * @param Adept_Config $filter
     */
    protected function configureFilter($config)
    {
        $class = $config->get('class');
        if ($class) {
             $filter = new $class();
             
             $filter->init($config);
             
             $this->registerFilter($filter);
        } else {
            throw new Adept_Exception('Invalid filter definition. Class not setted. ');
        }
    }
    
    /**
     * Initialize filters chain.
     * 
     * Override this method for initializing filters. 
     * 
     * @see registerFilters
     * @return void
     */
    public function initFilters() 
    {   
        if ($this->config == null) {
            return ;
        }
        
        $filters = $this->config->getAsList('filter');
        
        foreach ($filters as $filter) {
			$this->configureFilter($filter);
        }
        
        //$this->out($this->config);
    }
    
    public function initRenderKits()
    {
        if ($this->config == null) {
            return ;
        }
        $renderKits = $this->config->getAsList('renderkit');
        foreach ($renderKits as $renderKit) {
            if ($renderKit->get('path') != null) {
                $this->getContext()->getRenderKit()->importKit($renderKit->get('path'));
            }
        }
    }
    
    /**
     * @param Adept_Filter_IFilter $filter
     */
    protected function registerFilter($filter)
    {
        $this->getFilterChain()->append($filter);
    }
    
    protected function internalRedirect($url)
    {
        $currentUrl = $this->getContext()->getRequest()->getUrl()->__toString(array('path', 'query'));
        if ($currentUrl == $url) {
            $this->getLogger()->error('Internal redirect happened on url ' . $url);
            $this->handleRedirectLoop($url);
        }
        // Change server enviroment
        // TODO Think about it
        $_SERVER['REQUEST_URI'] = $url;
        $this->initContext();
        $this->runFilterChain();
    }
    
    public function runFilterChain()
    {
        try {
            // run services
            $this->filterChain->reset();
            $this->filterChain->next();
        } catch (Adept_Exception_InternalRedirect $exception) {
            
            $url = $exception->getUrl();
            $this->internalRedirect($url);
        } catch (Adept_Exception_Redirect $exception) {
            // Do nothing - redirect
        } catch (Adpet_Exception_Error403 $exception) {
            // Unresolved error 403 catched
            $this->getLogger()->info('Error 403 catched');
            $this->handleError403($exception);
        } catch (Adept_Exception_Error404 $exception) {
            // Unresolved error 404 catched
            $this->getLogger()->info('Error 404 catched');
            $this->handleError404($exception);
        } catch (Exception $exception) {
            // Unresolved exception
            $this->getLogger()->exception($exception);
            $this->handleException($exception);
        }
    }
    
    public function beforeRun()
    { }
    
    public function afterRun()
    { }

    final public function run()
    {
        try {
            $this->init();
            $this->beforeRun();
            $this->runFilterChain();
            $this->afterRun();
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }
    
    /**
     * @param Exception $exception
     */
    public function handleException($exception)
    {
        if ($exception instanceof Adept_Exception) {
            echo $exception->__toString();
        } else {
            if (php_sapi_name() != 'cli' && !isset($_REQUEST['ajax'])) {
                require_once('Adept/Exception/Renderer/Html.php');
                $renderer = new Adept_Exception_Renderer_Html();
            } else {
                require_once('Adept/Exception/Renderer/Text.php');
                $renderer = new Adept_Exception_Renderer_Text();
            }
            echo $renderer->render($exception);
        }
    }
    
    public function handleRedirectLoop($url)
    {
        throw new Adept_Exception_RedirectLoop($url);
    }
    
    public function handleError403($exception)
    {
    }

    /**
     * @todo Error404 defaul page
     * 
     * @param Adept_Exception $exception
     */
    public function handleError404($exception)
    {
        $response = $this->getContext()->getResponse();
        $response->setStatus(404);
        $response->write('<h1>Error 404. Requested page not found</h1>');
        $response->flush();
    }
    
    /**
     * @return Adept_Logger
     */
    public function getLogger()
    {
        return Adept_Logger::getLogger(__CLASS__);
    }
    
    // Getters-setters --------------------------------------------------------
    
    /**
     * @return Adept_Context
     */
    public function getContext() 
    {
        return $this->context;
    }
    
    /**
     * @param Adept_Context $context Context instance
     */
    public function setContext($context) 
    {
        $this->context = $context;
    }
    
    /**
     * Return application data strings encoding
     *
     * @return unknown
     */
    public function getEncoding() 
    {
        return $this->encoding;
    }
    
    /**
     * Set application data string encoding
     *
     * @param string $encoding
     */
    public function setEncoding($encoding) 
    {
        $this->encoding = $encoding;
    }
    
    public function getFilterChain() 
    {
        return $this->filterChain;
    }
    
    public function setFilterChain($filterChain) 
    {
        $this->filterChain = $filterChain;
    }    
    
}