<?php

/**
 * COOKIE
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

class Cookie {
	
	public static function exists($name) {
		return (isset($_COOKIE[$name])) ? true : false;
	}
	
	public static function get($name){
		return $_COOKIE[$name];
	}
	
	public static function put($name, $value, $expiry){
		if(setcookie($name, $value, time() + $expiry, '/')){
			return true;
		}
		return false;
	}
	
	public static function delete($name){
		self::put($name, '', time(-1));
	}
}
