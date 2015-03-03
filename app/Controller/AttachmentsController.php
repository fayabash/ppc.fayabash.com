<?php

App::uses('AppController', 'Controller');

/**
 * Attachments Controller
 *
 * @property Attachment $Attachment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AttachmentsController extends AppController {

    public $components = array('Paginator', 'Session');
    
    public function admin_list( $image = 'image' ) {
       
        $condtions = array(
            'Attachment.type' => array('image')
        );
        
        if( $image != 'image' ){
            $condtions = array(
                'NOT' => array(
                    array('Attachment.type' => array('image'))
                )
            );
        }
        
        $list = $this->Attachment->find('all',array(
           'fileds' =>array(
               'Attachment.name',
               'Attachment.path'
           ),
           'conditions' => $condtions,
           'order' => 'Attachment.name ASC'
       )); 
       
       $data = array();
       foreach( $list as $item ){
           $data[] = array(
               'title' => $item['Attachment']['name'],
               'value' => Router::url('/'.$item['Attachment']['path'], TRUE)
           );
       }
       unset($list);
       $this->set('data', $data);
       $this->layout = 'ajax';
       $this->render('/Common/ajax');
    }
    
    public function admin_uploadmany() {
        
    }

    public function admin_embed() {
        
    }

    public function admin_browse() {
        $this->admin_index();
        $this->layout = 'ajax';
    }

    public function admin_index() {
        $this->_setAttachments();
        $this->_setSubtypes();
    }

    public function admin_json_upload() {

        $data = array(
            'status' => 0
        );

        if ($this->request->is('post')) {
            $this->Attachment->create();
            if ($this->Attachment->save($this->request->data)) {
                $attachment = $this->Attachment->find('first', array(
                    'conditions' => array(
                        'Attachment.id' => $this->Attachment->getLastInsertID()
                    ),
                    'recursive' => -1
                ));
                $data = array(
                    'status' => 1,
                    'attachment' => $attachment['Attachment']
                );
            }
        }

        $this->set('data', $data);
        $this->layout = 'ajax';
        $this->render('/Common/ajax');
    }

    private function _lastIndexOf($item, $string) {

        $index = strpos(strrev($string), strrev($item));

        if ($index) {
            $index = strlen($string) - strlen($item) - $index;
            return $index;
        } else{
            return -1;
        }
    }

    public function admin_download($id) {

        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            throw new NotFoundException(__('Invalid attachment'));
        }
        
        $attachment = $this->Attachment->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Attachment.id' => $id
            )
        ));

        if (empty($attachment['Attachment']['path'])) {
            throw new NotFoundException(__('Sorry this attachment is not downloadable, it may be a youtube video or any other embed record'));
        } elseif ($attachment['Attachment']['type'] == 'embed') {
            throw new NotFoundException(__('Sorry this attachment is not downloadable, it may be a youtube video or any other embed record'));
        }
        
        $lastIndexOfPoint = $this->_lastIndexOf('.', $attachment['Attachment']['path']);
        $extension = substr($attachment['Attachment']['path'],$lastIndexOfPoint + 1);
        
        $path = substr($attachment['Attachment']['path'],0, $lastIndexOfPoint);
        $lastIndexOfSlash = $this->_lastIndexOf('/', $path);
        $path = substr($attachment['Attachment']['path'],0, $lastIndexOfSlash + 1);
        $fileId = substr($attachment['Attachment']['path'], $lastIndexOfSlash + 1);
        
        $lastIndexOfPoint = $this->_lastIndexOf('.', $attachment['Attachment']['name']);
        $name = substr($attachment['Attachment']['name'],0, $lastIndexOfPoint);
        
        $this->viewClass = 'Media';
        // Render app/webroot/files/example.docx
        $params = array(
            'id' => $fileId,
            'name' => $name,
            'download' => true,
            'extension' => $extension,
            'mimeType' => array(
                $extension => $attachment['Attachment']['type'] . '/' . $attachment['Attachment']['subtype']
            ),
            'path' => $path
        );
        $this->set($params);
        
    }

    private function _setAttachments() {
        $conditions = array();
        if (!empty($this->request->data)) {
            // filter
            if (array_key_exists('filter', $this->request->data)) {

                if ($this->request->data['filter'] != '-1') {
                    $conditions['Attachment.subtype LIKE'] = '%' . $this->request->data['filter'] . '%';
                }
            }
            // search
            if (array_key_exists('search', $this->request->data)) {
                $conditions['Attachment.name LIKE'] = '%' . $this->request->data['search'] . '%';
            }
        }

        $this->Paginator->settings = array(
            'conditions' => $conditions,
            'recursive' => -1
        );

        $this->set('attachments', $this->Paginator->paginate('Attachment'));
    }

    private function _setSubtypes() {
        $this->set('subtypes', $this->Attachment->find('all', array(
                    'fields' => array(
                        'DISTINCT Attachment.subtype',
                    ),
                    'group' => array('Attachment.subtype'),
                    'order' => array('Attachment.subtype ASC'),
                    'recursive' => -1
        )));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Attachment->exists($id)) {
            throw new NotFoundException(__('Invalid attachment'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Attachment->save($this->request->data)) {
                $this->Session->setFlash(__('The attachment has been saved'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The attachment could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
            }
        } else {
            $options = array('conditions' => array('Attachment.' . $this->Attachment->primaryKey => $id));
            $this->request->data = $this->Attachment->find('first', $options);
        }
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Attachment->id = $id;
        if (!$this->Attachment->exists()) {
            throw new NotFoundException(__('Invalid attachment'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Attachment->delete()) {
            $this->Session->setFlash(__('Attachment deleted'), 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Attachment was not deleted'), 'default', array('class' => 'alert alert-error'));
        return $this->redirect(array('action' => 'index'));
    }

}
