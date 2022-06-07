<?php

/**
 * URL
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.35
 */

class URL {

	private static
		$_url_data,
		$_module,
		$_lang = '',
		$_data = array();

	public static function setURLData($url) {
		self::$_url_data = $url;
		if(is_array($url)) {
			/* If URL is root - $url[0] is empty string ! */
			self::$_data = array_values($url);
		}
	}

	public static function isData() {
		if(empty(self::$_data)) {
			return false;
		}
		return true;
	}

	public static function getData($id = null) {
		if(isset($id)) {
			return self::$_data[$id];
		}
		return self::$_data;
	}

	public static function getURLData() {
		return self::$_url_data;
	}

	public static function setModule($module) {
		self::$_module = $module;
	}

	public static function getModule() {
		return self::$_module;
	}

	public static function setLang($lang) {
		self::$_lang = $lang;
	}

	public static function getLang() {
		return self::$_lang;
	}

	public static function removeRelativeDirectory($uri)
	{
		$uris = array();
		$tok = strtok($uri, '/');
		while ($tok !== FALSE)
		{
			if (( ! empty($tok) OR $tok === '0') && $tok !== '..')
			{
				$uris[] = $tok;
			}
			$tok = strtok('/');
		}

		return implode('/', $uris);
	}
}