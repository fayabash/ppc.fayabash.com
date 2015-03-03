<?php

App::uses('AppController', 'Controller');

/**
 * Pitches Controller
 *
 * @property Pitch $Pitch
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PitchesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Pitch->recursive = 0;
        $this->set('pitches', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->Pitch->exists($id)) {
            throw new NotFoundException(__('Invalid pitch'));
        }
        $options = array('conditions' => array('Pitch.' . $this->Pitch->primaryKey => $id));
        $this->set('pitch', $this->Pitch->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Pitch->create();
            if ($this->Pitch->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('The pitch has been saved'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pitch could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
            }
        }
        //$users = $this->Pitch->User->find('list');
        //$this->set(compact('users'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Pitch->exists($id)) {
            throw new NotFoundException(__('Invalid pitch'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Pitch->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('The pitch has been saved'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The pitch could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
            }
        } else {
            $options = array('conditions' => array('Pitch.' . $this->Pitch->primaryKey => $id));
            $this->request->data = $this->Pitch->find('first', $options);
        }
        $users = $this->Pitch->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Pitch->id = $id;
        if (!$this->Pitch->exists()) {
            throw new NotFoundException(__('Invalid pitch'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Pitch->delete()) {
            $this->Session->setFlash(__('Pitch deleted'), 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Pitch was not deleted'), 'default', array('class' => 'alert alert-error'));
        return $this->redirect(array('action' => 'index'));
    }

}
