<?php

/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
    private $_myHabtmOrderedModelNames = array(
        'Attachment' => array()
    );
    
    public function beforeValidate($options = array()) {
        if (!empty($this->data[$this->alias]['parent_id'])) {
            if ($this->data[$this->alias]['parent_id'] === '0' || $this->data[$this->alias]['parent_id'] === 0) {
                $this->data[$this->alias]['parent_id'] = null;
            }
        }
        
        return parent::beforeValidate($options);
    }
    
    public function saveAssociated($data = null, $options = array()) {
        
        foreach ($data as $alias => $modelData) {
            
            if (!empty($this->hasAndBelongsToMany[$alias])) {
                
                $order = $this->hasAndBelongsToMany[$alias]['order'];
                $orderClause = strpos($order, '.order');
                
                if(array_key_exists($alias, $this->_myHabtmOrderedModelNames) && $orderClause !== FALSE ){
                    if( !empty($modelData[$alias]) ){
                        if( array_key_exists('id',$modelData[$alias][0]) && array_key_exists('order',$modelData[$alias][0]) ){
                            $this->_myHabtmOrderedModelNames[$alias] = $modelData[$alias];
                            unset( $data[$alias] );
                        }
                    }
                }
                
                if(array_key_exists($alias, $this->_myHabtmOrderedModelNames) && $orderClause === FALSE ){
                    if( !empty($modelData[$alias]) ){
                        if( array_key_exists('id',$modelData[$alias][0]) && array_key_exists('order',$modelData[$alias][0]) ){
                            $newdata = array();
                            foreach( $modelData[$alias] as $row ){
                                $newdata[] = $row['id'];
                            }
                            $data[$alias] = $newdata;
                        }
                    }
                }
            }
        }
        return parent::saveAssociated($data, $options);
    }
    
    public function afterSave($created, $options = array()) {
        
        foreach( $this->_myHabtmOrderedModelNames as $alias => $rows  ){
            
            // if current model got an habtm assoc then...
            if (!empty($this->hasAndBelongsToMany[$alias])) {
                // save thoses data with passed order field!
                $this->_saveOrderedModelRows($alias);
            }
        }
        return parent::afterSave($created, $options);
    }
    
    private function _saveOrderedModelRows($alias){
        $rows = $this->_myHabtmOrderedModelNames[$alias];
        if( !empty($rows) ){
            
            // retrieve info about assoc table
            $modelTable = $this->hasAndBelongsToMany[$alias]['joinTable'];
            $tableNames = explode('_', $modelTable);
            
            $tempFKeyTable = explode('_',$this->hasAndBelongsToMany[$alias]['foreignKey']);
            
            $fKey = $this->hasAndBelongsToMany[$alias]['foreignKey'];
            $aKey = $this->hasAndBelongsToMany[$alias]['associationForeignKey'];

            // create queries
            $values = "";
            $id = $this->data[$this->alias][$this->primaryKey];
            foreach ($rows as $row) {
                $values .= "('$id','".$row['id']."','".$row['order']."'),";
            }
            $values = substr($values, 0, -1);
            
            $delete = "
                DELETE FROM
                    $modelTable
                WHERE
                    $fKey = $id
            ";
            
            $insert = "
                INSERT INTO
                    $modelTable
                    ($fKey,$aKey,`order`)
                VALUES
                    $values
            ";
            $this->query($delete);
            $this->query($insert);
        }
        
    }
}
