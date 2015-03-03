<?php

/* default:
****************************/
Configure::write('Storage.settings', array(
	
	'fileEngine' => 'local',
	
	'base'=>'files',
	
	'maxsize' => 30, // 30MB
	
	'path' => '{$modelName}{DS}{$year}',//'{$modelName}{DS}{$group}{DS}{$user}{DS}{$year}{DS}{$month}{DS}{$type}{DS}{$subtype}',
	
	'types' => array(
		
		'image/jpeg',
		'image/png',
		'image/gif',
		
		'application/pdf',
            
                'video/mp4',
                'video/ogg',
                'audio/ogg',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
	),
	
	'delete' => true

));

/* Cloudfiles exemple:
**************************
Configure::write('Storage.settings', array(
	
	'fileEngine' => 'cloudFiles',
	
	'base'=>'test',
	
	'enableCDN' => true,
	
	'maxsize' => 10,
	
	'path' => '{$year}{DS}{$month}',
	
	'types' => array(
		
		'image/jpeg',
		'image/png',
		'image/gif',
		
		'application/pdf'
	),
	
	'delete' => true,
	
	'user' => 'user',
	
	'secret' => 'secret'

));
*/

/* FTP exemple:
***************************
Configure::write('Storage.settings', array(
	
	'fileEngine' => 'ftp',
	
	'base'=>'test_storage',
	
	'maxsize' => 10,
	
	'path' => '{$year}{DS}{$month}',
	
	'types' => array(
		
		'image/jpeg',
		'image/png',
		'image/gif',
		
		'application/pdf'
	),
	
	'delete' => true,
	
	'user' => 'username',
	
	'password' => 'password',
 
        'server' => 'ftp.exemple.com',
    
        'domain' => 'http://www.exemple.com'

));
*/
