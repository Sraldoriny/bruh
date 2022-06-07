<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
mb_internal_encoding("UTF-8");

define('__PROJECTPATH__', dirname(dirname(__FILE__)));
define('__ROOT__', __PROJECTPATH__);  // compatible
define('__CORE__', dirname(__FILE__));

spl_autoload_register(function($class) {
	$class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
	$file = __CORE__ . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . $class . '.php';
	if(!is_readable($file)) {
		$file = __PROJECTPATH__ . Config::get("path/class") . $class . '.php';
	}
	require_once $file;
});

require_once 'functions/global.php';

define('__URL__', Config::get("web/url") . Config::get("web/dir"));