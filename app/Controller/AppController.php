<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $theme = 'Front';
    public $helpers = array('Markdown', 'Image', 'Embed', 'HtmlVersion');
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'invitations', 'action' => 'index', 'admin' => true),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'admin' => false, 'home'),
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
        $this->Auth->allow(array(
            'display',
            'json_create_user',
            'json_pitches_list',
                //'admin_add','admin_index','admin_edit','admin_delete'
        ));

        if (array_key_exists('admin', $this->request->params)) {
            $this->theme = 'Admin';

            // kick them off
            if ($this->Auth->user('role_id') != 1) {
                $this->Auth->deny();
            }
        }
        
        
    }

}
