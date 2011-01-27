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
 * @package    Adept_Renderer
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Renderer_Media_FlashMovie extends Adept_Renderer_Base 
{
    
    const CLASS_ID = 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000';
    const CODE_BASE = 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab';
    const PLUGINS_PAGE = 'http://www.macromedia.com/go/getflashplayer';
    
    /**
     * @param Adept_Component_Media_FlashMovie $component
     */
    public function renderBegin($component)
    {
        $writer = $this->getWriter();
        
        $version = $component->getAttribute('version', 6);
        
        $codeBase = self::CODE_BASE . '#version=' . $version . ',0,0,0';
        
        $writer->writeTag('object', array(
           'classid' => self::CLASS_ID,
           'codebase' => $codeBase,
           'width' => $component->getWidth(),
           'height' => $component->getHeight(),
           'id' => $component->getClientId(),
           'align' => $component->getAlign(),
        ));
        
        $writer->writeTag('param', array(
           'name' => 'movie',
           'value' => $component->getSrc(),
        ), true);
                
        $writer->writeTag('param', array(
           'name' => 'quality',
           'value' => 'high', 
        ), true);

        $writer->writeTag('param', array(
           'name' => 'bgcolor',
           'value' => $component->getBgcolor(), 
        ), true);
        
        $writer->writeTag('param', array(
           'name' => 'flashvars',
           'value' => $component->getFlashVars(),
        ), true);
        
        $writer->writeTag('embed', array(
           'src' => $component->getSrc(),
           'width' => $component->getWidth(),
           'height' => $component->getHeight(),
           'name' => $component->getClientId(),
           'align' => $component->getAlign(),
           'bgcolor' => $component->getBgcolor(),
           'flashvars' => $component->getFlashVars(),
           'quality' => 'high',
           'swliveconnect' => 'true',
           'type' => 'application/x-shockwave-flash',
           'pluginspage' => self::PLUGINS_PAGE,
           'wmode' => 'transparent',
        ));
        
        $writer->writeClosedTagLn('embed');
        
        $writer->writeClosedTagLn('object');        
    }
    
}