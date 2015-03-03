<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * CakePHP MainController
 * @author mike
 */
class MainController extends AppController {
    
    public function json_email(){
        
        $data = $this->request->input('json_decode');
        
        $Email = new CakeEmail();
        $Email->from(array('info@climatec-sa.com' => 'Site Climatec SA'));
        $Email->to($data->message->email);
        $Email->subject('Message de '.$data->message->name.' '. $data->message->email);
        
        if( $Email->send($data->message->message) ){
            $success = 1;
        }else{
            $success = 0;
        }
        
        $this->set(array(
            'success' => $success,
            '_serialize' => array('success')
        ));
    }
    
    public function display() {
        return $this->render('display');
    }

}
