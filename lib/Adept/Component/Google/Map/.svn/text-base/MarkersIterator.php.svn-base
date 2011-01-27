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

class Adept_Component_MarkersArray extends ArrayObject
{

    /**
     * @param Adept_Component_Composite $parent
     */
    public function __construct($parent)
    {
        parent::__construct($this->fetch($parent));
    }

    /**
     * @param Adept_Component_Composite $parent
     */
    protected function fetch($parent)
    {
        $result = array();

        foreach ($parent->getChildren() as $child) {
            if ($child instanceof Adept_Component_MapMarker) {
                $result[] = new Adept_Model_MapMarker($child->getDescription(), $child->getLatitude(), $child->getLongitude(), Adept_Model_MapMarker::TYPE_RED_MARKER);
            } elseif ($child instanceof Adept_Component_MapMarkers) {
                $values = $child->getValues();
                foreach ($values as $key => $value) {
                    if ($value instanceof Adept_Model_MapMarker) {
                        $result[] = $value;
                    } elseif (is_array($value)) {
                        $result[] = new Adept_Model_MapMarker($value['description'], $value['latitude'], $value['longitude'], Adept_Model_MapMarker::TYPE_RED_MARKER);
                    }
                }
            }
        }
        return $result;
    }

}