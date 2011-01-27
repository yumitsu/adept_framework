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

class Adept_Component_Message_ToolBox extends Adept_Component_AbstractControl  implements Adept_Component_DomContainer
{
    const TITLE_FACET = 'title';
    const SHOW_EVENT = 'show';
    
    protected function defineProperties()
    {
        parent::defineProperties();
        $this->addPropertyDescription('absoluteId', array(), false, self::TYPE_BOOL);
        $this->addPropertyDescription('cssPrefix', array(self::CAP_PERSISTENT));
        $this->addPropertyDescription('open', array(self::CAP_PERSISTENT));
    }

    public function getDomContainerId()
    {
        return $this->getClientId() . ':holder';
    }

    public function hasRenderer()
    {
        return true;
    }

    public function getDefaultRendererType()
    {
        return 'Adept_Renderer_Message_ToolBox';
    }
    
    public function getRequiredCss()
    {
        return array();
//        if ($this->getCssPrefix() != 'a-toolbox') {
//            return array();
//        }
//        
//        return array('Adept/toolbox.css');
    }

    // Properties---------------------------------------------------------------
    
    public function getCssPrefix()
    {
        return $this->getProperty("cssPrefix", 'a-toolbox');
    }

    public function setCssPrefix($cssPrefix)
    {
        $this->setProperty("cssPrefix", $cssPrefix);
    }

    public function isAjaxLoading()
    {
        return $this->getProperty("ajaxLoading", false);
    }

    public function setAjaxLoading($ajaxLoading)
    {
        $this->setProperty("ajaxLoading", $ajaxLoading);
    }

    public function isOpen()
    {
        return $this->getProperty("open", true);
    }

    public function setOpen($open)
    {
        $this->setProperty("open", $open);
    }
    
    public function isAbsoluteId()
    {
        return $this->getProperty("absoluteId");
    }

    public function setAbsoluteId($absoluteId)
    {
        $this->setProperty("absoluteId", $absoluteId);
    }
    
}