<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class MultiuploadBehavior extends ModelBehavior {

    public $settings = array();
    private $_fileToRemove = array();
    public $default_settings = array(
        'base' => 'files',
        'maxsize' => 10, // 10MB in octet
        'path' => '{$year}{DS}{$month}', //'{$modelName}{DS}{$year}{DS}{$month}{DS}{$type}{DS}{$subtype}',
        'types' => array(
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf'
        ),
        'delete' => true,
        'allowEmpty' => true
    );

    public function setup(Model $model, $settings = array()) {

        if (empty($settings)) {
            throw new Exception('MultiuploadBehavior: Invalid settings');
        }

        foreach ($settings as $field => $setting) {

            if (!is_string($field)) {
                throw new Exception('MultiuploadBehavior: Settings key must be a string');
            }

            $this->settings[$model->alias][$field] = array_merge(
                    $this->default_settings, (array) $setting
            );
        }
    }

    /**
     * getPath method used to set the path to upload file in beforeSave method
     * 
     * 
     * @param Model $model 
     * @param string $path like '{$modelName}{DS}{$year}{DS}{$month}{DS}{$type}{DS}{$subtype}{DS}{$fileName}'
     * @param string $type image|application|etc...
     * @param string $subtype jpeg|gif|png etc..
     * @return string 
     */
    public function getPath( Model $model, $path, $type, $subtype) {

        $path = str_replace(array(
            '{$modelName}',
            '{DS}',
            '{$year}',
            '{$month}',
            '{$type}',
            '{$subtype}'
                ), array(
            $model->alias,
            DS,
            date("Y"),
            date("m"),
            $type,
            $subtype
                ), $path);

        return $path;
    }

    /**
     * beforeValidate method check if file fit to criteria
     * 
     * @param Model $model
     * @return boolean
     * @throws Exception throws exception if file do not fit to settings
     */
    public function beforeValidate(Model $model, $options = array()) {

        $validation = array();

        foreach ($this->settings[$model->alias] as $field => $settings) {
            if (empty($model->data[$model->alias][$field]) && $settings['allowEmpty']) {
                array_push($validation, true);
                continue;
            }

            if (empty($model->data[$model->alias][$field]) && !$settings['allowEmpty']) {
                $model->invalidate($field, __('A file is required, try again.'));
                array_push($validation, false);
                continue;
            }

            if (isset($model->data[$model->alias][$field])) {
                if ($model->data[$model->alias][$field] != '' && !empty($model->data[$model->alias][$field]) && is_array($model->data[$model->alias][$field])) {

                    // CHECK upload success
                    if ($model->data[$model->alias][$field]['error'] != 0 && !$settings['allowEmpty']) {
                        $model->invalidate($field, __('An upload error occured, try again.'));
                        array_push($validation, false);
                        continue;
                    }

                    if ($model->data[$model->alias][$field]['error'] != 0 && $settings['allowEmpty']) {
                        array_push($validation, true);
                        continue;
                    }

                    // CHECK type
                    if (( in_array($model->data[$model->alias][$field]['type'], $settings['types']) === false)) {
                        $model->invalidate($field, __('This file type is not suported, try again.'));
                        array_push($validation, false);
                        continue;
                    }

                    // CHECK Size
                    if (( ( $settings['maxsize'] * ( 1024 * 1024 * 1000 ) ) + 1 ) < $model->data[$model->alias][$field]['size']) {
                        $model->invalidate($field, __('This file is too large the max size is : ') . $settings['maxsize'] . ' MB ' . __('try again'));
                        array_push($validation, false);
                        continue;
                    }
                }
            }
        }

        return !in_array(FALSE, $validation);
    }

    /**
     * 
     * @param Model $model
     * @return boolean
     * @throws Exception
     */
    public function beforeSave( Model $model, $options = array()) {

        $validation = array();

        foreach ($this->settings[$model->alias] as $field => $settings) {

            if (isset($model->data[$model->alias][$field])) {

                if ($model->data[$model->alias][$field] != '' && !empty($model->data[$model->alias][$field]) && is_array($model->data[$model->alias][$field])) {

                    // allowEmpty
                    if ($settings['allowEmpty'] && $model->data[$model->alias][$field]['error'] != 0) {
                        unset($model->data[$model->alias][$field]);
                        array_push($validation, true);
                        continue;
                    }

                    // NAME
                    $name = time() . '_' . preg_replace('/[^a-z0-9_.]/i', '', strtolower($model->data[$model->alias][$field]['name']));

                    // TEMPNAME
                    $temp_name = $model->data[$model->alias][$field]['tmp_name'];

                    // TYPE
                    $fullType = $model->data[$model->alias][$field]['type'];
                    $type = explode('/', $fullType);
                    $subtype = $type[1];
                    $type = $type[0];

                    $path = WWW_ROOT . $settings['base'] . DS . $this->getPath($model, $settings['path'], $type, $subtype);
                    $folder = new Folder();
                    $folder->create($path, false);

                    //debug( $conf['base'] . DS . $this->getPath($model, $conf['path'], $type, $subtype) . DS . $name );

                    if (move_uploaded_file($temp_name, $path . DS . $name)) {
                        $model->data[$model->alias][$field] = $settings['base'] . DS . $this->getPath($model, $settings['path'], $type, $subtype) . DS . $name;
                        array_push($validation, true);
                        continue;
                    } else {
                        $model->invalidate($field, __('Unable to move file on Server, try again.'));
                        array_push($validation, false);
                        continue;
                    }
                }
            }
        }

        return !in_array(FALSE, $validation);
    }

    /**
     * 
     * @param Model $model
     * @return boolean
     */
    function beforeDelete(Model $model, $cascade = true) {

        foreach ($this->settings[$model->alias] as $field => $settings) {

            $fileToRemove = false;
            $model->read(null, $model->id);
            if (isset($model->data)) {

                if (!empty($model->data[$model->alias][$field]) && $settings['delete']) {
                    $fileToRemove = $model->data[$model->alias][$field];
                }
            }

            array_push($this->_fileToRemove, $fileToRemove);
        }


        return true;
    }

    /**
     * 
     * @param Model $model
     * @return boolean
     */
    function afterDelete(Model $model) {

        $validation = array();

        foreach ($this->_fileToRemove as $fileToRemove) {
            
            if ($fileToRemove) {
                $file = new File(WWW_ROOT . $fileToRemove);
                if ($file->delete()) {
                    array_push($validation, true);
                    continue;
                } else {
                    $model->invalidate($field, __('The file could not be delete, please contact the webmaster.'));
                    array_push($validation, false);
                    continue;
                }
            }
        }

        return !in_array(FALSE, $validation);
    }

}