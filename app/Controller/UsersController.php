<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {
    
    public $uses = array('User','Pitch');
    
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    
    private function _book( $data ){
        $this->Session->delete('data');
        $pitches = $this->Pitch->find('all',array(
            'conditions' => array(
                'Pitch.start' => $data['Pitch']['start'],
                'Pitch.end'=> $data['Pitch']['end']
            )
        ));
        
        foreach($pitches as $key => $pitch){
            if( count($pitch['User']) >= $pitch['Pitch']['max_user'] ){
                unset($pitches[$key]);
            }
        }
        
        if( count($pitches) > 0 ){
            
            $p = $pitches[0]['Pitch'];
            
            $user = $this->User->find('first',array(
                'conditions' => array(
                    'User.id' => $this->Auth->user('id')
                )
            ));
            
            $times = 0;
            
            foreach( $user['Pitch'] as $userKey => &$userPitch ){
                
                $up = $userPitch['Pitch'];
                
                switch($data['Pitch']['type']){

                    default:
                        // peux pas se démultiplier! et peux pas jouer pd un tournois
                        $start = strtotime($p['start']);
                        $end = strtotime($p['end']);
                        
                        $ustart = strtotime($up['start']);
                        $uend = strtotime($up['end']);
                        
                        if( ($end <= $uend && $ustart >= $start) || ($uend <= $end && $start <= $ustart)){
                            $this->Session->setFlash('Vous avez déjà une réservation, ou un tournois pour cette tranche horraire', 'default', array('class' => 'alert alert-danger'));
                            return false;
                        }
                        

                    case 'pitch':
                        // pas plus de 2 fois par jour
                        $udate = date('Y-m-d',strtotime($up['start']));
                        $udate = strtotime($udate);
                        
                        $date = date('Y-m-d',strtotime($p['start']));
                        $date = strtotime($date); 
                        
                        if( $udate == $date ){
                            $times++;
                        }
                        
                        // pas 2 fois successivement
                        if( ($p['start'] == $up['end']) || ($p['end'] == $up['start']) ){
                            $this->Session->setFlash('Vous ne pouvez pas jouer 2 parties successivement!', 'default', array('class' => 'alert alert-danger'));
                            return false;
                        }
                        
                        break;

                    case 'tournament':
                        
                        
                        break;
                }
                
                if( $times >= 2 ){
                    $this->Session->setFlash('Vous ne pouvez pas jouer plus de 2 fois par jour!', 'default', array('class' => 'alert alert-danger'));
                    return false;
                }
            }
            
            array_push($user['Pitch'], $p );
            
            if( $this->User->saveAssociated($user) ){
                return TRUE;
            }else{
                $this->Session->setFlash('Une faute de programmation est survenue! Veuillez essayer à nouveau!', 'default', array('class' => 'alert alert-danger'));
                return false; 
            }
            
        }else{
            $this->Session->setFlash('Cette réservation est déjà prise. Veuillez recommencer.', 'default', array('class' => 'alert alert-danger'));
            return false;
        }
        
        return FALSE;
    }
    
    public function player_bookings(){
        $data = $this->Session->read('data');
        if( $data ){
            if( $this->_book($data) ){
                $this->Session->setFlash('Votre inscription a bien été ajoutée!', 'default', array('class' => 'alert alert-success'));
            }else{
               $this->redirect(array(
                   'controller' => 'pitches',
                   'action' => 'index',
                   'player' => FALSE
               )); 
            }
        }
        
        $this->set('user', $this->User->find('first',array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            )
        )));
        
    }
    
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Nom d\'user ou mot de passe invalide, réessayer'));
            }
        }
        //$this->theme = 'Front';
        //$this->layout = 'login';
    }

    public function admin_login() {
        $this->redirect(array('action' => 'login', 'admin' => false));
    }

    public function admin_logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    /*
    public function json_bookings(){
        
        $user = $this->User->find('first',array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            )
        ));
        
        unset($user['User']['id']);
        unset($user['User']['password']);
        unset($user['User']['role_id']);
        unset($user['Role']);
        
        $this->set(array(
            'data' => $user,
            '_serialize' => array('data')
        ));
    }
    
    public function json_logout(){
        $this->Auth->logout();
        $this->set(array(
            'data' => array(
                'message' => 'Vous avez bien été loggé out'
            ),
            '_serialize' => array( 'data')
        ));
    }
    
    public function json_login(){
        
        //https://developer.paypal.com/docs/classic/api/errorcodes/
        $data = array(
            'state' => 'error',
            'code' => '1001',
            'message' => __('Nom d\'user ou mot de passe invalide, réessayer')
        );
        
        if ($this->request->is('post')) {
            if ($this->Auth->login()){
                $data = array(
                    'state' => 'success',
                    'message' => __('Nom d\'user ou mot de passe invalide, réessayer')
                );
            }
        }
        
        $this->set(array(
            'data' => $data,
            '_serialize' => array( 'data')
        ));
    }
    */
    
    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->User->recursive = 0;
        
        $this->Paginator->settings = array(
            'recursive' => 0,
            'limit' => 50,
            'order' => array(
                'User.email' => 'ASC'
            )
        );
        
        $users = $this->Paginator->paginate('User');
        
        $this->set('users', $users);
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
            }
        }
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-error'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'), 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'), 'default', array('class' => 'alert alert-error'));
        return $this->redirect(array('action' => 'index'));
    }

}
