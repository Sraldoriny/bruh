<?php

/**
 * BOOTSTRAP
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.1
 */

class Bootstrap {

	public function __construct() {
		$uri = parse_url('http://dummy'.$_SERVER['REQUEST_URI']);
		$uri = isset($uri['path']) ? $uri['path'] : '';
		$uri = URL::removeRelativeDirectory($uri);
		$uri = explode("/", trim($uri,"/"));
		$config_dir = trim(Config::get("web/dir"), "/");
		if($config_dir) {
			if($uri[0] == $config_dir) {
				array_shift($uri);
			}
		}

		$moduleFromURL = $uri[0];

		/* can't directly call index.php */
		if($moduleFromURL === "index.php") {
			Redirect::to(404);
		}

		URL::setURLData($uri);
		
		if(empty($moduleFromURL)) {
			/* empty -> go to index */
			$moduleFromURL = 'index';
		}

		if(!ctype_alnum($moduleFromURL)) {
			Redirect::to(404);
		}

		URL::setModule($moduleFromURL);
		ModuleCore::start($moduleFromURL);
	}

}