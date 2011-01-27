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

class Adept_Validator_PositiveNumber extends Adept_Validator_Number 
{
    public function validate($sender, $value)
    {
        if (trim($value) == '') {
            return ;
        }
        parent::validate($sender, $value);
        $iValue = (int) $value;
        if ($iValue <= 0) {
            $title = $this->getComponentTitle($sender);
            $message = $this->getMessage();
            if ($message == null) {
                $message = $this->getBundleMessage('not_positive_number');
            }
            
            throw new Adept_Validator_Exception($message, 
                Adept_Message::ERROR, array('value' => $value, 'field' => $title));
        }
    }
}