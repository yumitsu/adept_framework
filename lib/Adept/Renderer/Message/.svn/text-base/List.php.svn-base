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

class Adept_Renderer_Message_List extends Adept_Renderer_Base
{

    /**
     * @param Adept_Component_Message_List $component
     */
    public function renderChildren($component)
    {
        $messages = $component->getMessages();
        
        if (count($messages) == 0) {
            // Nothing to display
            return ;
        }
        
        $writer = $this->getWriter();

        $writer->writeTag('ul', array('class' => $component->getCssClass(), 'style' => $component->getCssStyle()));
        foreach($messages as $message) {
            $writer->writeHtml('<li>');
            $this->renderMessage($component, $message);
            $writer->writeHtml('</li>');
        }
        $writer->writeHtml('</ul>');
    }
    
    /**
     * Returns CSS style for specified $message.
     *
     * @param Adept_Component_Message_List $component
     * @param Adept_Message $message
     */
    private function getMessageCssClass($component, $message)
    {
        switch ($message->getType()) {
            case Adept_Message::ERROR:
                return $component->getErrorClass();
            case Adept_Message::HINT:
                return $component->getHintClass();
            case Adept_Message::INFORM:
                return $component->getInformClass();
            case Adept_Message::WARNING:
                return $component->getWarningClass();
            default:
                return null;
        }
    }
    
    /**
     * Returns CSS style for specified $message.
     *
     * @param Adept_Component_Message_List $component
     * @param Adept_Message $message
     */
    private function getMessageCssStyle($component, $message)
    {
        switch ($message->getType()) {
            case Adept_Message::ERROR:
                return $component->getErrorStyle();
            case Adept_Message::HINT:
                return $component->getHintStyle();
            case Adept_Message::INFORM:
                return $component->getInformStyle();
            case Adept_Message::WARNING:
                return $component->getWarningStyle();
            default:
                return null;
        }
    }
    
    /**
     * Render message item
     *
     * @param Adept_Message $message
     */
    protected function renderMessage($component, $message)
    {
        $writer = $this->getWriter();
        
        $class = $this->getMessageCssClass($component, $message);
        $style = $this->getMessageCssStyle($component, $message);
        
        if ($class == null) {
            $class = $component->getDefaultClass();
        }

        if ($style == null) {
            $style =  $component->getDefaultStyle();
        }
        
        $writer->writeTag('span', array('class' => $class, 'style' => $style));
        $writer->writeText($message->getTitle());
        $writer->writeClosedTag('span');
    }

}
