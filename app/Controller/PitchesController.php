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
    
    public function admin_list(){
        $pitches = $this->Pitch->find('all',array(
            'conditions' => array(
                'Pitch.end > NOW()',
            ),
            'order' => array(
                'Pitch.start' => 'ASC',
                'Pitch.title' => 'ASC',
                'Pitch.max_user' => 'ASC'
            )
        ));
        
        foreach($pitches as $key => $pitch){
            if( count($pitch['User']) < 1 ){
                unset($pitches[$key]);
            }
        }
        
        $this->set('picthes',$pitches);
    }
    
    public function sumup(){
        
        if ($this->request->is('post')) {
            $this->Session->write('data', $this->request->data );
            $this->set('pitch', $this->request->data);
            $this->set('user', $this->Auth->user());
        }else{
            $this->Session->setFlash('Une erreure c\'est produite veuillez réserver à nouveau!', 'default', array('class' => 'alert alert-warning'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    
    public function index(){
        
        // clean all after 2 days..
        $this->Pitch->deleteAll(array(
            'Pitch.end < NOW() + INTERVAL 2 DAY'
        ));
        
        $pitches = $this->Pitch->find('all',array(
            'conditions' => array(
                'Pitch.end > NOW()',
            ),
            'order' => array(
                'Pitch.start' => 'ASC',
                'Pitch.title' => 'ASC',
                'Pitch.max_user' => 'ASC'
            )
        ));
        
        
        $simples = array();
        $tournaments = array();
        
        foreach($pitches as $key => $pitch){
            if( count($pitch['User']) >= $pitch['Pitch']['max_user'] ){
                unset($pitches[$key]);
            }else{
                $pitch['Pitch']['user_left'] = $pitch['Pitch']['max_user'] - count($pitch['User']);
                unset($pitch['User']);
                if( $pitch['Pitch']['max_user'] == 1){
                    $k = $pitch['Pitch']['start'].'_'.$pitch['Pitch']['end'];
                    if( !array_key_exists($k, $simples) ){
                        $simples[$k] = array();
                    }
                    array_push($simples[$k], $pitch);
                    
                    
                    
                }else{
                    array_push($tournaments, $pitch);
                }
            }
        }
        
        $this->set('simples',$simples);
        $this->set('tournaments',$tournaments);
    }
    
    /*
    public function json_pitches_list(){
        
        $pitches = $this->Pitch->find('all');
        
        $this->set(array(
            'header' => $_SERVER['HTTP_AUTHORIZATION'],
            'pitches' => $pitches,
            '_serialize' => array('header','pitches')
        ));
    }
    */
    
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
            //debug($this->request->data);
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
