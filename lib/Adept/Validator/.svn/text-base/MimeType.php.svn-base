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

class Adept_Validator_MimeType extends Adept_Validator_Abstract
{
    
    public function validate($sender, $value)
    {
        if ($value == null){
            return ;
        }
        
        if($value instanceof Adept_List){
           
            foreach ($value as $current){
                $this->check($sender, $current);
            }
        }else{
            $this->check($sender, $value);
        }
        
        
    }
    
    private function check($sender, $value)
    {
        if (!is_array($value) && !($value instanceof Adept_UploadedFile)){
            throw new Adept_Exception_IllegalArgument('Illegal binding parameter');
        }
        
        
        if (!in_array($value['type'], $this->getTypes())){
            $title = $this->getComponentTitle($sender);
            $message = $this->getMessage('invalid_file_type');
            
            throw new Adept_Validator_Exception($message, 
                Adept_Message::ERROR, array('field' => $title));
        }
    	
    }
    
    
    public function getTypes()
    {
        return explode(',', $this->getParameter('types', ''));
    }
}

