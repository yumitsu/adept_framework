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
 * @package    Adept_Validator
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Validator_InArray extends Adept_Validator_Abstract
{
    const ARRAY_ATTRIBUTE = 'array';
    const IN_ARRAY_ATTRIBUTE = 'inArray';
    
    public function validate($sender, $value)
    {
        $title = ($sender instanceof Adept_Component_AbstractControl) ? $sender->getTitle() : '';
        $message = $this->getMessage();
            
        if ($this->isInArray()) {
            if (!in_array(trim($value), $this->getArray())) {
                if ($message == null) {
                    $message = $this->getBundleMessage('not_in_array');
                }
                throw new Adept_Validator_Exception($message, 
                    Adept_Message::ERROR, array('value' => $value, 'field' => $title));
            }
        } else {
            if (in_array(trim($value), $this->getArray())) {
                if ($message == null) {
                    $message = $this->getBundleMessage('in_array');
                }
                throw new Adept_Validator_Exception($message, 
                    Adept_Message::ERROR, array('value' => $value, 'field' => $title));
            }
        }
    }

    public function getArray() 
    {
        return $this->getParameter(self::ARRAY_ATTRIBUTE, array());
    }
    
    public function isInArray() 
    {
        return $this->getBoolParameter(self::IN_ARRAY_ATTRIBUTE, true);
    }
    
}