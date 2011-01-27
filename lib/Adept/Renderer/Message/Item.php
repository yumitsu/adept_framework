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
 * @package    Adept_Renderer
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Renderer_Message_Item extends Adept_Renderer_Base 
{

    protected $style;
    protected $class;

    public function setErrorStyle($val)
    {
        $this->setStyle($val, Adept_Message::ERROR);
    }

    public function setWarningStyle($val)
    {
        $this->setStyle($val, Adept_Message::WARNING);
    }

    public function setInformStyle($val)
    {
        $this->setStyle($val, Adept_Message::INFORM);
    }

    public function setInformClass($val)
    {
        $this->setClass($val, Adept_Message::INFORM);
    }

    public function setWarningClass($val)
    {
        $this->setClass($val, Adept_Message::WARNING);
    }

    public function setErrorClass($val)
    {
        $this->setClass($val, Adept_Message::ERROR);
    }

    public function getStyle($type)
    {
        return isset($this->style[$type]) ? $this->style[$type] : null;
    }

    public function setStyle($style, $type)
    {
        $this->style[$type] = $style;
    }

    public function getClass($type)
    {
        return isset($this->class[$type]) ? $this->class[$type] : null;
    }

    public function setClass($class, $type)
    {
        $this->class[$type] = $class;
    }

    public function renderChildren($component)
    {
        $message = $component->getMessage();
        if(!is_null($message))    {

            $this->setErrorClass($component->getErrorClass());
            $this->setInformClass($component->getInformClass());
            $this->setWarningClass($component->getWarningClass());

            $this->setErrorStyle($component->getErrorStyle());
            $this->setInformStyle($component->getInformStyle());
            $this->setWarningStyle($component->getWarningStyle());

            $this->renderMessage($message, $this->getWriter());
        }
    }

    protected function renderMessage($message, $writer)
    {
        $attrubutes['class'] = $this->class[$message->getType()];

        $attrubutes['style'] = $this->style[$message->getType()];

        $writer->writeHtmlTag('span', $attrubutes);
        $writer->writeHtml($message->getTitle());
        $writer->writeClosedHtmlTag('span');
    }

}