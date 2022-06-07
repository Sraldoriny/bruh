<?php

/**
 * SESSION
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.22
 */

class Session {
	
	public static function exists($name) {
		return (isset($_SESSION[$name])) ? true : false;
	}
	
	public static function put($name, $value) {
		return $_SESSION[$name] = $value;
	}

	public static function add($name, $value) {
		if(!self::exists($name)) {
			$_SESSION[$name] = array();
		}
		if(is_array($_SESSION[$name])) {
			$_SESSION[$name][] = $value;
			return true;
		}
		return false;
	}

	public static function get($name) {
		if(self::exists($name)) {
			return $_SESSION[$name];
		}
		return '';
	}
		
	public static function delete($name) {
		if(self::exists($name)) {
			unset($_SESSION[$name]);
		}
	}
	
}