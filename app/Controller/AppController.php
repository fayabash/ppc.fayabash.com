<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $theme = 'Front';
    public $helpers = array('Markdown', 'Image', 'Embed', 'HtmlVersion');
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'users', 'action' => 'bookings', 'player' => true, 'admin' => false),
            'logoutRedirect' => array('controller' => 'pitches', 'action' => 'index', 'player' => false, 'admin' => false),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email')
                )
            ),
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => false
            ),
        ),
        'RequestHandler'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        
        // Auth
        $this->Auth->authorize = array('Controller');
        
        $this->Auth->allow(array(
            'display',
            'index',
            'view',
            'add',
            'sumup',
            'delete'
                //'admin_add','admin_index','admin_edit','admin_delete'
        ));
        
        /*
        if ( $this->params['prefix'] == 'json' ){
            $this->set('_jsonp', true);
        }
        */
        
        $this->set('is_logged', $this->Auth->user());
        
        if (array_key_exists('admin', $this->request->params) ) {
            $this->theme = 'Admin';
        }
        
        if( !$this->Auth->isAuthorized() && array_key_exists('admin', $this->request->params) && $this->Auth->user() ){
            $this->redirect('/');
        }
        
        /*
        if( !$this->Auth->isAuthorized($this->Auth->user(), $this->request) && array_key_exists('json', $this->request->params)){
            $this->redirect(array('controller' => 'users', 'action' => 'logout', 'json' => TRUE));
        }*/
    }
    
    public function isAuthorized () {
        if ( array_key_exists('admin', $this->request->params) ) {
            return $this->Auth->user('role_id') == 1 ;
        }else{
            return $this->Auth->user('role_id') < 3 ;
        }
        return parent::isAuthorized () ;
    }

}
