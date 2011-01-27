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

class Adept_Ajax_Channel
{
    
    const PRIORITY_NORMAL = 50;
    
    /**
     * @var Adept_List
     */
    protected $pool;

    protected $commands = array(
        'alert' => 'Adept_Ajax_Command_Alert',
        'event' => 'Adept_Ajax_Command_Event',
        'update' => 'Adept_Ajax_Command_Update',
        'replace' => 'Adept_Ajax_Command_Replace',
        'redirect' => 'Adept_Ajax_Command_Redirect',
        'evaluate' => 'Adept_Ajax_Command_Eval',
        'invoke' => 'Adept_Ajax_Command_Invoke',
        'append' => 'Adept_Ajax_Command_Append',
        'googleSynchronize' => 'Adept_Ajax_Command_GoogleSynchronize',
    );
    
    public function __construct()
    {
        $this->pool = new Adept_List();
    }
    
    protected $encoding = null;
    
    /**
     * Add custom command class.
     *
     * @param string $alias Command alias.
     * @param string $className Command class name. 
     */
    public function registerCommand($alias, $className)
    {
        $this->commands[$alias] = $className;
    }
    
    // Base commands ----------------------------------------------------------
    
    public function alert($message, $priority = self::PRIORITY_NORMAL)
    {
        $this->execute('alert', array($message), $priority);
    }
    
    public function event($element, $event, $evaluateElement = false, $priority = self::PRIORITY_NORMAL)
    {
        $this->execute('event', array($element, $event, $evaluateElement), $priority);
    }
    
    public function update($clientId, $content, $priority = self::PRIORITY_NORMAL)
    {
        $this->execute('update', array($clientId, $content));
    }

    public function redirect($url, $priority = self::PRIORITY_NORMAL)
    {
        $this->execute('redirect', array($url), $priority);
    }
    
    public function replace($clientId, $content, $priority = self::PRIORITY_NORMAL)
    {
        $this->execute('replace', array($clientId, $content), $priority);
    }
    
    public function evaluate($expression, $priority = self::PRIORITY_NORMAL)
    {
        $this->execute('evaluate', array($expression), $priority);
    }
    
    public function invoke($controllerId, $methodName, $params = array(), $priority = self::PRIORITY_NORMAL)
    {
        $this->execute('invoke', array($controllerId, $methodName, $params), $priority);
    }
    
    public function googleSynchronize($id, $data, $priority = self::PRIORITY_NORMAL)
    {
    	$this->execute('googleSynchronize', array($id, $data), $priority);
    }
    
    public function append($parentId, $data, $priority = self::PRIORITY_NORMAL)
    {
    	$this->execute('append', array($parentId, $data), $priority);
    }

    // Command applying routine -----------------------------------------------
    
    public function execute($command, $params, $priority = self::PRIORITY_NORMAL)
    {
        if (!isset($this->commands[$command])) {
            throw new Adept_Exception_IllegalArgument("Command '{$command}' not registered");
        }
        
        $commandClass = $this->commands[$command];
        if (!class_exists($commandClass)) {
            throw new Adept_Exception_IllegalArgument("Command class '{$commandClass}' not found");
        }
    
        $command = Adept_ClassKit_Util::createObject($commandClass, $params);
        $this->addCommand($command, $priority);
    }
    
    /**
     * Add command to execution list
     *
     * @param Adept_Ajax_Command $command
     */
    public function addCommand($command, $priority = self::PRIORITY_NORMAL)
    {
        $item = new Adept_Map();
        $item->set('command', $command);
        $item->set('priority', $priority);
        $this->pool->add($item);
        
    }
    
    public function toArray()
    {
        $result = array();
        $pool = $this->pool->toArray(); 
        usort($pool, array('Adept_Ajax_Channel', 'compareCommand'));
        foreach ($pool as $command) {
            $result[] = $command->get('command')->toArray(); 
        }
        return $result;
    }
    
    public function commit()
    {
        $result = Adept_Json::encode($this->toArray());
        
        // TODO: Question of encoding
        
        $encoding = $this->getEncoding();
        if ($encoding != 'UTF-8') {
            $result = iconv($encoding, 'UTF-8', $result);
        }
        
        Adept_Context::getInstance()->getResponse()->write('<<COMMANDS>>' . $result . '<<END_OF_COMMANDS>>');
        
        $this->pool->removeAll(); 
    }
    
    // Magic function support -------------------------------------------------
    
    public function __call($command, $params)
    {
        $this->execute($command, $params);
    }
    
    public function getEncoding() 
    {
        if($this->encoding === null){
            $this->encoding = Adept_Context::getInstance()->getApplication()->getEncoding(); 
        }
        return $this->encoding;
    }
    
    public function setEncoding($encoding) 
    {
        $this->encoding = $encoding;
    }
    
    static function compareCommand($a, $b)
    {
        if ($a->get('priority') == $b->get('priority')) {
            return 0;
        }
        if ($a->get('priority') > $b->get('priority')) {
            return -1;
        }
        return 1;
    }

}

