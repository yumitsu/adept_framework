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
 * @package    Adept
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_MessageSet
{

    /**
     * Messages map
     *
     * @var Adept_Map
     */
    protected $messages;
    
    static protected $instance = null;

    /**
     * @deprecated Use Adept_Context::getInstance()->getMessageSet() instead.
     * 
     * @return Adept_MessageSet
     */
    static public function getInstance() 
    {   
        return Adept_Context::getInstance()->getMessageSet();
    }

    /**
     * Returns messages map (Lazy initialization).
     * 
     * @return Adept_Map
     */
    private function getMessagesMap()
    {
        if ($this->messages == null) {
            $this->messages = new Adept_Map();
        }
        return $this->messages;
    } 
    
    /**
     * @param string $key
     * @param string $group
     * @return Adept_Message
     */
    public function getMessage($key) 
    {
        return $this->getMessagesMap()->get($key);
    }

    /**
     * Returns messages in group if $group specified; all groups otherwise.
     *
     * @param string $group
     * @return Adept_Map
     */
    public function getMessages($group = null) 
    {
        if ($group == null) {
            return $this->getMessagesMap(); 
        } 
        // Filter messages by group and return result array.
        $result = new Adept_Map();
        foreach ($this->getMessagesMap() as $id => $message) {
            if ($message->getGroup() == $group) {
                $result[$id] = $message;
            }
        }
        return $result;
    }
    
    public function hasMessage($key) 
    {
        return $this->getMessagesMap()->has($key);
    }    
    
    /**
     * Add message to context
     *
     * @param string $key
     * @param Adept_Message $message
     * @param string $group 
     */
    public function setMessage($key, $message, $group = null) 
    {
        if (!$message instanceof Adept_Message) {
            throw new Adept_Exception_IllegalArgument();
        }
        $this->getMessagesMap()->set($key, $message);
        if ($group != null) {
            $message->setGroup($group);
        }
    }
    
    public function addError($key, $message, $group = null)
    {
        $this->setMessage($key, new Adept_Message($message, Adept_Message::ERROR, $group));
    }
    
    public function addWarning($key, $message, $group = null)
    {
        $this->setMessage($key, new Adept_Message($message, Adept_Message::WARNING, $group));
    }
    
    public function addHint($key, $message, $group = null)
    {
        $this->setMessage($key, new Adept_Message($message, Adept_Message::HINT, $group));
    }
    
    public function addInfo($key, $message, $group = null)
    {
        $this->setMessage($key, new Adept_Message($message, Adept_Message::INFORM, $group));
    }
    

}