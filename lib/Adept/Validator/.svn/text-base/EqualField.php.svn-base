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

class Adept_Validator_EqualField extends Adept_Validator_Abstract 
{

    public function validate($sender, $value) 
    {
        $id = $this->getField();
        if ($id == null) {
            throw new Adept_Template_Exception("Undefined 'field' attribute");
        }
        $field = $sender->getRootView()->findChildById($id);
        if ($field == null) {
            throw new Adept_Template_Exception("Component '{$id}' not found");
        }
        if ($value != $field->getValue()) {
            // @todo Refactor $title: move title recognition method.
            $title1 = ($sender instanceof Adept_Component_AbstractControl) ? $sender->getTitle() : '';
            $title2 = ($field instanceof Adept_Component_AbstractControl) ? $field->getTitle() : '';
            
            $message = $this->getMessage();
            if ($message == null) {
                $message = $this->getBundleMessage('fields_are_not_equal');
            }
            
            throw new Adept_Validator_Exception($message, 
                Adept_Message::ERROR, 
                array(
                    'value1' => $value, 
                    'value2' => $field->getValue(),
                    'field1' => $title1,
                    'field2' => $title2,
                ));
        }
    }
    
    public function getField()
    {
        return $this->getParameter('field');
    }

}
