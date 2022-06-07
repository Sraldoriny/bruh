<?php

/**
 * CONFIG
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

class Config {

	private static
		$dir = "config",
		$loaded = false,
		$data = array();

	public static function init()
	{	
		if(self::$loaded) {
			return;
		}
		$dir = __CORE__ . DIRECTORY_SEPARATOR . self::$dir;
		$objects = @scandir($dir);
		if($objects === false) {
			return;
		}
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				$file = $dir . DIRECTORY_SEPARATOR . $object;
				if (is_readable($file)) {
					require $file;
					self::$data = array_merge(self::$data, $config);
					self::$loaded = true;
				}
			}
		}
		if(!self::$loaded) {
			ErrorCore::render("Can't find config file(s).");	
		}
	}

	public static function get($path, $default = null) {
		if(!$path) {
			return false;
		}
		self::init();

		$config = self::$data;
		$path = explode('/', $path);
		
		foreach($path as $bit) {
			if(isset($config[$bit])) {
				$config = $config[$bit];
			}
			else {
				if(isset($default))
					return $default;
				return '';
			}
		}
		return $config;
	}

	public static function exists($path){
		if(!$path) {
			return false;
		}
		self::init();

		$config = self::$data;
		$path = explode('/', $path);
		
		foreach($path as $bit) {
			if(isset($config[$bit])) {
				$config = $config[$bit];
			}
			else {
				return false;
			}
		}
		return true;
	}

}
