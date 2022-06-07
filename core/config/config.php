<?php

$config = array(
	'mysql' => array(
		'host' => 'sql16.dnsserver.eu',
		'username' => 'db31629xasd',
		'password' => 'WrSnoz?9zv8',
		'db' => 'db31629xasd',
		'prefix' => ''
	),
	'table' => array(
		'users' => 'users',
		'users_session' => 'users_session',
		'settings' => 'settings'
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token',
		'notify_name' => 'notify',
	),
	'path' => array(
		'class' => '/app/class/',
		'include' => '/app/include/',
		'modules' => '/app/modules/',
		'models' => '/app/models/',
		'lang' => '/app/lang/',
		'menu' => '/app/menu/',
		'log' => '/app/_log/',
	),
	'lang' => array(
		'default' => 'sk',
		'translate_modules' => false,
		'all' => array(
			'sk' => 'Slovensky',
			'en' => 'English'
		)
	),
	'app' => array(
		'version' => '1.0.1',
	),
	'web' => array(
		'dir' => '',
		'url' => 'https://asd.awebin.sk',
		'title' => ' |ASD Web',
		// 'footer_copyright' => ''
	),
	'file' => array(
		'ext' => array('doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'pdf', 'zip', 'rar', 'cdr', 'dxf'),
		'max_length' => 5242880
	),
	'log' => [
        'type' => 'file',   //db or file
        'path' => 'app/data/log.txt',
    ]
);
