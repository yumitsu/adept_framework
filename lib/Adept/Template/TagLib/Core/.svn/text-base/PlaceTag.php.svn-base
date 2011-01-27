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
 * @package    Adept_Template
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Template_TagLib_Core_PlaceTag extends Adept_Template_Tag
{
    const CAPTURE_CLASS = 'Adept_Template_TagLib_Core_CaptureTag';
    
    public function prepare() 
    {
        $captured = $this->getRoot()->findChildrenByClass(self::CAPTURE_CLASS, true);
        // TODO Sort captured branches.
        
        $found = array();
        foreach ($captured as $capture) {
            if (strcasecmp($capture->getAttributeValue('name'), $this->getAttributeValue('name')) == 0) {
                $found[] = $capture;
            }
        }
        
        if (count($found) > 0) {
            // Clear children before
            $this->children = new Adept_List();
            foreach ($found as $placeItem) {
                $children = $placeItem->getChildren();
                foreach ($children as $child) {
                    $this->addChild($child);
                }
            }
        } 
        
        parent::prepare();
    }

}
