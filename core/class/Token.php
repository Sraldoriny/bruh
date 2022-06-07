<?php

/**
 * TOKEN
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.17
 */

class Token {

	const
		SESSION_NAME = "token";

	public static function get($name = 'default') {
		$session_name = self::getSessionName();
		if(!isset($_SESSION[$session_name][$name])) {
			return self::generate($name);
		}
		return $_SESSION[$session_name][$name];
	}

	public static function generate($name = 'default') {
		return $_SESSION[self::getSessionName()][$name] = Hash::token();
	}

	public static function generateModal() {
		return self::generate("modal");
	}

	public static function generateAjax($name = 'default') {
		return self::generate("ajax");
	}
	
	public static function check($token, $name = 'default') {
		$session_name = self::getSessionName();
		
		if(isset($_SESSION[$session_name][$name])) {
			if($token === $_SESSION[$session_name][$name]) {
				unset($_SESSION[$session_name][$name]);
				return true;
			}
			unset($_SESSION[$session_name][$name]);
		}
		return false;
	}

	public static function checkOnly($token, $name = 'default') {
		$session_name = self::getSessionName();
		
		if(isset($_SESSION[$session_name][$name])) {
			if($token === $_SESSION[$session_name][$name]) {
				return true;
			}
			unset($_SESSION[$session_name][$name]);
		}
		return false;
	}

	public static function checkModal($token) {
		return self::check($token, "modal");
	}

	public static function checkAjax($token) {
		return self::checkOnly($token, "ajax");
	}

	private static function getSessionName() {
		return Config::get('session/token_name', self::SESSION_NAME);
	}

}
