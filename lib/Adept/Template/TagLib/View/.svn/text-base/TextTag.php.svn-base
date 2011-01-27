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

class Adept_Template_TagLib_View_TextTag extends Adept_Template_TagLib_View_ComponentTag 
    implements Adept_Template_TextNode 
{
    
    protected $text = null;
    
    public function __construct()
    {
        parent::__construct('__text');
    }
    
    public function prepare()
    {
        $this->componentClass = 'Adept_Component_Text';
        if (null === $this->text) {
            // TODO Define text from children nodes 
        }
    }

    public function generateSetters($writer, $var)
    {
        $writer->writePhp("{$var}->setText(");
        $writer->writePhpLiteral($this->text);
        $writer->writePhp(");\n");           
    }
    
    public function getText() 
    {
        return $this->text;
    }
    
    public function setText($text) 
    {
        $this->text = $text;
    }
    
}