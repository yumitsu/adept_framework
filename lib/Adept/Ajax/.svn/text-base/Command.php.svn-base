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
 * @package    Adept_Ajax
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Ajax_Command
{

    protected $commandType;

    public function __construct($commandType = null)
    {
        if ($commandType === null) {
            $commandType = str_replace('_', '.', get_class($this));
        }
        $this->commandType = $commandType;
    }
    
    public function setCommandType($commandType)
    {
        $this->commandType = $commandType;
    }
    
    public function execute()
    {
        Adept_Context::getInstance()->getAjaxChannel()->addCommand($this);
    }

    public function toArray()
    {
        $record = array();
        foreach ($this as $property => $value) {
            if ($property == 'commandType') {
                $record['commandType'] = $value;
            } else {
                $record['params'][$property] = $value;
            }
        }
        return $record;
    }

}
