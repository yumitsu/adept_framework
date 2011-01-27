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
 * @package    Adept_Controller
 * @copyright  Copyright (c) 2007-2008 Versus group Inc. (http://www.versus-group.ru)
 * @license    http://adept-project.com/license/     BSD License
 * @version    $Id: $
 */

class Adept_Controller_Crud extends Adept_Controller_Base 
{
    
    const MODE_CREATE = 'create';
    const MODE_EDIT = 'edit';
    
    protected $modelClass;
    
    /**
     * @var Adept_Orm_Record
     */
    protected $model;
    
    /**
     * @var Adept_Orm_Record
     */    
    protected $currentModel;
    
    protected $id;
    
    protected $mode;
    
    protected $list = null;
    
    protected $checkAcl = true;

    protected $successUrl = null;
    
    public function __construct($modelClass, $id = null, $checkAcl = true)
    {
        $this->modelClass = $modelClass;
        if ($id !== null) {
            $id = (int) $id;
        }
        $this->id = $id;
        $this->checkAcl = $checkAcl;
    }
    
    public function getProperty($name)
    {
        return Adept_ClassKit_Util::getPropertyValue($this->getModel(), $name);
    }
    
    public function setProperty($name, $value)
    {
        Adept_ClassKit_Util::setPropertyValue($this->getModel(), $name, $value);
    }
    
    /**
     * @return Adept_Orm_Record
     */
    public function getModel()
    {
        if ($this->model === null) {
            if ($this->id !== null) {
                // Edit exists model 
                $this->model = $this->getOrmSession()->tryLoad($this->modelClass, 
                    $this->id);
                if ($this->model === false) {
                    $this->onLoadError();                                
                }
                $this->mode = self::MODE_EDIT;
                $this->onInitEdit($this->model);
            } else {
                // Create new model
                $this->model = new $this->modelClass();
                $this->mode = self::MODE_CREATE;
                $this->onInitNew($this->model);
            }
        }
        return $this->model;
    }

    public function onInitEvent($event)
    {
        ;
    }
    
    public function getList()
    {
        if ($this->list === null) {
            $this->list = $this->onGetList();
        }
        return $this->list;
    }
    
    // List support ------------------------------------------------------------
    
    public function getCurrentModel()
    {
        return $this->currentModel;
    }
    
    public function setCurrentModel($model)
    {
        $this->currentModel = $model;
    }
    
    // User handlers -----------------------------------------------------------
    
    /**
     * Override to initialize new model instance.
     *
     * @param Adept_Orm_Record $model
     */
    protected function onInitNew($model)
    {
    }
    
    protected function onInitEdit($model)
    {
    }
    
    protected function onCheckCreate($model)
    {
        return true;
    }
    
    protected function onCheckEdit($model)
    {
        if (!$this->getAcl()->isAllowed($model, 'edit')) {
            $this->onAclError();
            return false;
        };
        return true;
    }
    
    protected function onCheckDelete($model)
    {
        if (!$this->getAcl()->isAllowed($model, 'delete')) {
            $this->onAclError();
            return false;
        };
        return true;
    }
    
    protected function onLoadError()
    {
        throw new Adept_Exception_Error404();
    }
    
    protected function onAclError()
    {
        throw new Adept_Exception_Error403();
    }
    
    protected function onGetList()
    {
        return $this->getOrmSession()->find($this->modelClass);
    }
    
    protected function onBeforeSave($model)
    {
    }
    
    protected function onAfterSave($model)
    {
    }
    
    protected function onBeforeDelete($model)
    {
    }
    
    protected function onAfterDelete($model)
    {
    }
    
    // Actions -----------------------------------------------------------------
    
    protected function _save($model)
    {
        if ($this->checkAcl) {
            if ($this->mode == self::MODE_EDIT) {
                $pass = $this->onCheckEdit($model);
            } elseif ($this->mode == self::MODE_CREATE) {
                $pass = $this->onCheckCreate($model);
            }
            if (!$pass) {
                $this->onAclError();
            }
        }
        
        if ($this->onBeforeSave($model) === false) {
            return ;
        }
        $this->getOrmSession()->save($model);
        $this->getOrmSession()->commit();
        $this->list = null;
        $this->onAfterSave($model);
    }
    
    public function save()
    {
        $this->_save($this->getModel());
        if ($this->successUrl != null) {
            $this->getResponse()->redirect($this->successUrl);
        }
    }
    
    protected function _delete($model)
    {
        if ($this->checkAcl && !$this->onCheckDelete($model)) {
            return ;
        }
        if ($this->onBeforeDelete($model) === false) {
            return ;
        }
        $this->getOrmSession()->delete($model);
        $this->getOrmSession()->commit();
        $this->list = null;
        $this->onAfterDelete($model);
    }
    
    public function delete()
    {
        $this->_delete($this->getModel());
        if ($this->successUrl != null) {
            $this->getResponse()->redirect($this->successUrl);
        }
    }
    
    public function deleteCurrent()
    {
        $this->_delete($this->getCurrentModel());
    }
    
    // Misc functions ----------------------------------------------------------
    
    /**
     * @return Adept_Orm_Session
     */
    protected function getOrmSession()
    {
        return Adept_Orm_Session_Factory::getSession();
    }
    
    /**
     * @return User
     */    
    public function getUser()
    {
        return $this->getContext()->getUser();
    }    
    
    protected function getAcl()
    {
        return Adept_Context::getInstance()->getAcl();
    }
    
    public function isEditMode()
    {
        return $this->mode == self::MODE_EDIT;
    }
    
    public function isCreateMode()
    {
        return $this->mode == self::MODE_CREATE;
    }
    
    public function getSuccessUrl() 
    {
        return $this->successUrl;
    }
    
    public function setSuccessUrl($successUrl) 
    {
        $this->successUrl = $successUrl;
    }
    
}