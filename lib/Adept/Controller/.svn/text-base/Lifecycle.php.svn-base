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
 * @package    Adept_Controller
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

/**
 * @todo Refactor
 */
class Adept_Controller_Lifecycle extends Adept_Controller_Base implements Adept_Controller_Processable 
{

    const TEMPLATE = 'tpl';
    const CACHE_STRATEGY = 'Adept_Controller_Lifecycle';
    const CACHE_GROUP = 'Adept_Controller_Lifecycle';
    const PARTITION = '_partition';
    
    protected $template = null;

    public function process()
    {
        $request = Adept_Context::getInstance()->getRequest();
        if ($this->template === null) {
            if (!$request->hasParameter(self::TEMPLATE)) {
                throw new Adept_Exception("Parameter " . self::TEMPLATE . " not defined in request");
            }
            $tpl = $request->getParameter(self::TEMPLATE);
        } else {
            $tpl = $this->template;
        }
        $this->processLifecycle($tpl);
    }
    
    protected function calculateUniqueId()
    {
        $url = Adept_Context::getInstance()->getRequest()->getUrl();
        $parts = Adept_Util_Uri::getPathElements($url->getPath());
        return 'viewId_' . implode('_', $parts);  
    }
    
    public function processLifecycle($tpl)
    {
        $root = $this->getViewLoader()->loadTemplate($tpl);

        // calculate unique id
        
        $root->setUniqueId($this->calculateUniqueId());
        
        Adept_Context::getInstance()->setRootView($root);
        
        $lifecycle = Adept_Lifecycle::getInstance();
        $lifecycle->init();
        $request = Adept_Context::getInstance()->getRequest();
        if ($request->isAjax() && $request->has(self::PARTITION)) {
            $root = $this->makePartition($root, $request->get(self::PARTITION));
        }
        Adept_Context::getInstance()->setRootView($root);
        
        
        $lifecycle->execute();
        $lifecycle->render();
    }
    
    
    /**
     *
     * @param Adept_Component_RootView $root
     * @param unknown_type $id
     * @return unknown
     */
    private function makePartition($root, $id)
    {
       $partition = $root->findChildById($id);
       
       $ec = $root->getExpressionContext()->toArray();
       
       if ($partition && $partition instanceof Adept_Component_Partition){
           
            $root = new Adept_Component_RootView();
            
            $root->getExpressionContext()->merge($ec);
            $root->addChild($partition);    
       }
       return $root;
    }
    
    /**
     * @return Adept_ViewLoader
     */
    protected function getViewLoader()
    {
    	return Adept_ViewLoader::getInstance();
    }
    
    
    public function getTemplate() 
    {
        return $this->template;
    }
    
    public function setTemplate($template) 
    {
        $this->template = $template;
    }

}
