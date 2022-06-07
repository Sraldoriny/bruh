<?php

/**
 * REDIRECT
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.26
 */

class Redirect {

	public static function to($location = null) {
		if(empty($location)) {
			header('Location: '. Config::get("web/url"));
			exit();
		}
		else {
			if(is_numeric($location)) {
				$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
				switch($location) {
					case 404:
						header( $protocol . ' 404 Not Found');
						$file = __PROJECTPATH__ . Config::get("path/include"). "404.inc.php";
						if(is_readable($file)) {
							require $file;
							exit;
						}
						ErrorCore::render("<b>404</b> File or page has not been found.");
						exit();
					break;
				}
			}
			header('Location: '. $location);
			exit();
		}
	}

}

?>