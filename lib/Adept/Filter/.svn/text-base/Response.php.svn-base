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

class Adept_Filter_Response extends Adept_Filter_Abstract 
{
    
    public function process($chain) 
    {
        $buffer = new Adept_Response_Output_Buffer();
            
        $response = Adept_Context::getInstance()->getResponse();
        
        $response->startCapture();
        
        $chain->next();
        
        $buffer = $response->endCapture();
        
        $response->write($buffer->getContent());
        
        $response->flush();
    }    
    
}