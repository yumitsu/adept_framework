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

class Adept_Filter_Timing extends Adept_Filter_Abstract 
{

    protected $display = 'block';
    
    public function init($config)
    {
        if (!$config) {
            return ;
        }
        if ($config['display']) {
            $this->display = $config['display'];
        }
    }
    
    public function process($chain)
    {
        $loader = Adept_ClassLoader::getInstance();
        $loader->setCalcParingTime(true);
        
        $this->startTime = $this->getMicroTime();
        $chain->next();
        
        $totalTime = round($this->getMicroTime() - $this->startTime, 3);
        
        $message = '<small>[' . __CLASS__ . '] Total time: ' . $totalTime . ' sec, ';
        $message .= ' PHP Parsing time: ' . round($loader->getParsingTime(), 3) . ' sec, ';
        $message .= ' PHP Run time: ' . round($totalTime - $loader->getParsingTime(), 3) . ' sec '; 
        $message .= '</small>';
        
        if (!Adept_Context::getInstance()->getRequest()->isAjax()) {
            
            $style = 'display: ' . $this->display . '; '; 
            
            $this->getContext()->getResponse()->write('<div id="_timing" style="' . $style . '">' . $message . '</div>');
        } else {
            
            $this->getContext()->getAjaxChannel()->update('_timing', $message);
            $this->getContext()->getAjaxChannel()->commit();
        }
    }

    public function getMicroTime() 
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

}
