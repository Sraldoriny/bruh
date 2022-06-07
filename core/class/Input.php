<?php

/**
 * INPUT 
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.12
 */

class Input {
	
	public static function exists($type = 'post') {
		switch($type) {
			case 'post':
				return(!empty($_POST)) ? true : false;
			break;
			case 'get':
				return(!empty($_GET)) ? true : false;
			break;
			default:
				return false;
			break;
		}
	}
	
	public static function get($item) {
		if(isset($_POST[$item])) {
			return $_POST[$item];
		} else if(isset($_GET[$item])) {
			return $_GET[$item];
		}
		return '';
	}

	public static function issetGet($item) {
		return (isset($_GET[$item])) ? true : false;
	}

	public static function issetPost($item) {
		return (isset($_POST[$item])) ? true : false;
	}

	public static function validate(array $array, $method = "_POST") {
		$v = new Validate;
		$v->check(${$method}, $array);
		return $v->passed();
	}
}
