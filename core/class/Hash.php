<?php

/**
 * HASH
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

class Hash {
	
	public static function make($string, $salt = '') {
		return hash('sha256', $string . $salt);
	}

	public static function salt($length) {
		return random_bytes($length);
	}

	public static function unique() {
		return self::make(uniqid());
	}
	
	public static function token() {
		return hash('sha256', self::salt(10) . uniqid());
	}
}
