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
 * @package    Adept_Bundle
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Bundle_Locator extends Adept_Locator
{
    
    const LOCALE_PARAM = 'locale';    

    public function __construct($locations = array('.'))
    {
        parent::__construct($locations);
        $this->addLocations(Adept_Locator_Util::getIncludeLocations());
    }
    
    public function locate($alias, $params = array())
    {
        $result = false;
        $locale = isset($params[self::LOCALE_PARAM]) ? $params[self::LOCALE_PARAM] : null;
        if ($locale != null) {
            $result = parent::locate($alias . '.'. $locale . '.ini');
        }
        if (!$result) {
            $result = parent::locate($alias . '.ini');
        }
        return $result;
    }
    
    public function unresolvedAlias()
    {
        return null;
    }
    
}
