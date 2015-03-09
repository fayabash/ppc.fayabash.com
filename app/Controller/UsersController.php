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
        
        $availablePitch = array();
        
        foreach($pitches as $key => $pitch){
            if( count($pitch['User']) >= $pitch['Pitch']['max_user'] ){
                unset($pitches[$key]);
            }else{
                if(empty($availablePitch)){
                    $availablePitch = $pitch;
                }
            }
        }
        
        if( count($pitches) > 0 ){
            
            // ici prob!!
            $p = $availablePitch['Pitch'];
            
            $user = $this->User->find('first',array(
                'conditions' => array(
                    'User.id' => $this->Auth->user('id')
                )
            ));
            
            $times = 0;
            
            foreach( $user['Pitch'] as $userKey => &$userPitch ){
                
                $up = $userPitch;
                
                
                // peux pas se démultiplier! et peux pas jouer pd un tournois
                $start = strtotime($p['start']);
                $end = strtotime($p['end']);

                $ustart = strtotime($up['start']);
                $uend = strtotime($up['end']);

                if( $end <= $uend && $ustart >= $start){
                    $this->Session->setFlash('Vous avez déjà une réservation, ou un tournoi pour cette tranche horraire', 'default', array('class' => 'alert alert-danger'));
                    return false;
                }
                
                if( $uend <= $end && $start <= $ustart ) {
                    $this->Session->setFlash('Vous avez déjà une réservation, ou un tournoi pour cette tranche horraire', 'default', array('class' => 'alert alert-danger'));
                    return false;
                }



                // pas plus de 2 fois par jour
                $udate = date('Y-m-d',strtotime($up['start']));
                $udate = strtotime($udate);

                $date = date('Y-m-d',strtotime($p['start']));
                $date = strtotime($date); 

                if( $udate == $date ){
                    $times++;
                }

                // pas 2 fois successivement
                if( $p['start'] == $up['end'] ){
                    $this->Session->setFlash('Vous ne pouvez pas jouer 2 parties successivement!', 'default', array('class' => 'alert alert-danger'));
                    return false;
                }
                if( $p['end'] == $up['start'] ){
                    $this->Session->setFlash('Vous ne pouvez pas jouer 2 parties successivement!', 'default', array('class' => 'alert alert-danger'));
                    return false;
                }
                        
                       
                
                if( $times >= 2 ){
                    $this->Session->setFlash('Vous ne pouvez pas jouer plus de 2 fois par jour!', 'default', array('class' => 'alert alert-danger'));
                    return false;
                }
            }
            
            // add pitch to array!
            array_push($user['Pitch'], $p );
            
            $newUser = array(
                'User' => array(
                    'id' => $user['User']['id']
                ),
                'Pitch' => array(
                    'Pitch' => array()
                )
            );
            
            // format data for save
            foreach( $user['Pitch'] as $userKey => $userPitch ){
               array_push($newUser['Pitch']['Pitch'], $userPitch['id']);
            }
            
            //debug($newUser);
            
            if( $this->User->saveAssociated($newUser) ){
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
    
    public function add(){
        if ($this->request->is('post')) {
            
            $control = TRUE;
            
            $user = $this->request->data;
            if( empty($user['User']['password']) ){
                $this->Session->setFlash('Votre mot de passe est vide!', 'default', array('class' => 'alert alert-danger'));
                $control = FALSE;
            }
            
            if( empty($user['User']['firstname']) ){
                $this->Session->setFlash('Votre prénom de passe est vide!', 'default', array('class' => 'alert alert-danger'));
                $control = FALSE;
            }
            
            if( empty($user['User']['lastname']) ){
                $this->Session->setFlash('Votre nom de passe est vide!', 'default', array('class' => 'alert alert-danger'));
                $control = FALSE;
            }
            
            if( empty($user['User']['mobile']) ){
                $this->Session->setFlash('Votre mobile de passe est vide!', 'default', array('class' => 'alert alert-danger'));
                $control = FALSE;
            }
            
            if( $user['User']['password'] != $user['User']['password_confirm'] ){
                $this->Session->setFlash('Les mots de passe ne correspondes pas!', 'default', array('class' => 'alert alert-danger'));
                $control = FALSE;
            }
            
            if( strlen($user['User']['password']) < 6 ){
                $this->Session->setFlash('Votre mots de passe doit contenir au moins 6 caractères!', 'default', array('class' => 'alert alert-danger'));
                $control = FALSE;
            }
            
            if( strlen($user['User']['username']) < 3 ){
                $this->Session->setFlash('Votre nom d\'utilisateur est trop court', 'default', array('class' => 'alert alert-danger'));
                $control = FALSE;
            }
            
            if( strlen($user['User']['username']) > 6 ){
                $this->Session->setFlash('Votre nom d\'utilisateur est trop long', 'default', array('class' => 'alert alert-danger'));
                $control = FALSE;
            }
            
            $email = $this->User->find('count',array(
                'recursive' => -1,
                'conditions' => array(
                    'User.email' => $user['User']['email']
                )
            ));
            
            if( $email > 0 ){
                $this->Session->setFlash('Cet email existe déjà, veuillez vous logger!', 'default', array('class' => 'alert alert-warning'));
                $control = FALSE;
            }
            
            $name = $this->User->find('count',array(
                'recursive' => -1,
                'conditions' => array(
                    'User.username' => $user['User']['username']
                )
            ));
            
            if( $name > 0 ){
                $this->Session->setFlash('Ce nom d\'utilsateur est déjà pris, veuillez vous en choisir un autre!', 'default', array('class' => 'alert alert-warning'));
                $control = FALSE;
            }
            
            if( $control ){
                $user['User']['role_id'] = 2;
                
                $this->User->create();
                if ($this->User->saveAssociated($user)) {
                    $this->Session->setFlash('Votre inscription a bien été effectuée, bienvenue dans votre espace ping pong club!', 'default', array('class' => 'alert alert-success'));
                    $user = $this->User->find('first',array(
                        'conditions' => array(
                            'User.email' => $user['User']['email']
                        )
                    ));
                    $user['User']['Role'] = $user['Role'];
                    $this->Auth->login($user['User']);
                    return $this->redirect(array('action' => 'bookings', 'player' => TRUE));
                } else {
                    $this->Session->setFlash('L\'inscription n\'a pu être faite, veuillez controller vos données!', 'default', array('class' => 'alert alert-danger'));
                }
            }
        }
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
    
    public function player_delete($id = null) {
        $this->Pitch->id = $id;
        if (!$this->Pitch->exists()) {
            throw new NotFoundException(__('Cette réservation existe pas!'));
        }
        $this->request->onlyAllow('post', 'delete');
        
        $user = $this->User->find('first',array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            )
        ));
        
        $newUser = array(
            'User' => array(
                'id' => $this->Auth->user('id')
            ),
            'Pitch' => array(
                'Pitch' => array()
            )
        );
        
        foreach( $user['Pitch'] as $pitch ){
            if( $pitch['id'] != $id ){
                array_push($newUser['Pitch']['Pitch'], $pitch['id']);
            }
        }
        
        if ($this->User->saveAssociated($newUser)) {
            $this->Session->setFlash(__('Réservation effacée'), 'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('action' => 'bookings'));
        }
        $this->Session->setFlash(__('La réservation n a pas pu être effacée'), 'default', array('class' => 'alert alert-error'));
        return $this->redirect(array('action' => 'bookings'));
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
    
    public function logout() {
        return $this->redirect($this->Auth->logout());
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
