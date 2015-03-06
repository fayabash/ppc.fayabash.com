<?php
// to js app...
Router::connect('/', array('controller' => 'main', 'action' => 'display'));
Router::connect('/admin', array('controller' => 'pitches', 'action' => 'index','admin' => TRUE));
Router::connect('/app/**', array('controller' => 'main', 'action' => 'display'));

// JSONP app...
Router::mapResources('main');
Router::mapResources('users');
Router::mapResources('pitches');
Router::parseExtensions();


CakePlugin::routes();


require CAKE . 'Config' . DS . 'routes.php';
