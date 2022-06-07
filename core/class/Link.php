<?php

/**
 * LINK
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.25
 */

class Link {

	public static function to() {
		$args = func_get_args();
		if(is_array($args[0])) {
			$args = $args[0];
		}
		$link = Config::get("web/dir");
		foreach($args as $key => $arg) {
			if(is_array($arg) && !empty($arg)) {
				$link .= "/?" . http_build_query($arg);
				return $link;
			}
			else if(!empty($arg)) {
				$link .= "/" . $arg;
			}
		}
		return $link . "/";
	}	

	public static function toIndex() {
		return __URL__;
	}

}