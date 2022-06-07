<?php

/**
 * LANG
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.70
 */

class Lang {

	private static
		$langDirCore = '/lang/',
		$defaultCoreLang = "en";

	private static
		$_data = array(),
		$_data_core = array(),
		$_lang,
		$_lang_core,
		$_lang_name;

	public function __construct($lang = null) {
		$lang = self::getRightLang($lang);
		self::loadLangPack($lang);
		if(empty(self::$_data_core)) {
			self::loadCoreLangPack($lang);
		}
	}

	public static function get($path, $wordA = null, $wordB = null) {
		list($section, $key) = explode('/', $path);
		if($key) {
			if(!isset(self::$_data[$section][$key])) {
				return 'LANG[' . $path . ']';
			}
			if(empty($wordA)) {
				return self::$_data[$section][$key];	
			}
			if(empty($wordB)) {
				return sprintf(self::$_data[$section][$key], $wordA);	
			}
			return sprintf(self::$_data[$section][$key], $wordA, $wordB);
		}
		return self::$_data[$section];
	}

	public static function exists($path) {
		list($section, $key) = explode('/', $path);
		if($key) {
			if(isset(self::$_data[$section][$key])) {
				return true;
			}
			return false;
		}
		if(isset(self::$_data[$section])) {	
			return true;
		}
		return false;
	}

	/* loading language pack for app */
	public static function loadLangPack($lang) {
		$file = __PROJECTPATH__ . Config::get('path/lang') . $lang . ".ini";
		if(!is_readable($file)) {
			$lang = Config::get('lang/default');
			$file = __PROJECTPATH__ . Config::get('path/lang') . $lang . ".ini";
			if(!is_readable($file)) {
				ErrorCore::render("Can't load default (". $lang .") language pack.");
			}
		}
		self::$_data = parse_ini_file($file, true);	
		self::$_lang = $lang;
		self::$_lang_name = self::getLangName($lang);
		return true;
	}

	/* loading language pack for core classes */
	public static function loadCoreLangPack($lang = null) {
		if(empty($lang)) {
			$lang = URL::getLang();
			if(empty($lang)) {
				$lang = (Config::exists('lang/default')) ? Config::get('lang/default') : self::$defaultCoreLang;
			}
		}
		$file = __CORE__ . self::$langDirCore . $lang . ".ini";
		if(!is_readable($file)) {
			$lang = self::$defaultCoreLang;
			$file = __CORE__ . self::$langDirCore . $lang . ".ini";
			if(!is_readable($file)) {
				ErrorCore::render("Can't load Core language pack.");
			}
		}
		self::$_data_core = parse_ini_file($file, true);
		self::$_lang_core = $lang;
	}

	public static function lazyLoadCore() {
		if(empty(self::$_data_core)) {
			self::loadCoreLangPack();
		}
		return;
	}

	public static function core($path, $wordA = null, $wordB = null) {
		self::lazyLoadCore();
		list($section, $key) = explode('/', $path);
		if($key) {
			if(!isset(self::$_data_core[$section][$key])) {
				return 'LANGCORE[' . $path . ']';
			}
			if(empty($wordA)) {
				return self::$_data_core[$section][$key];	
			}
			if(empty($wordB)) {
				return sprintf(self::$_data_core[$section][$key], $wordA);	
			}
			return sprintf(self::$_data_core[$section][$key], $wordA, $wordB);
		}
		return self::$_data_core[$section];
	}	

	public static function getError($mix = null) {
		self::lazyLoadCore();
		$wordA = null;
		$wordB = null;
		if(is_array($mix)) {
			$key = $mix[0];
			$wordA = $mix[1];
			$wordB = $mix[2];
		}
		else {
			$key = $mix;
		}
		$section = "Errors";
		if($key) {
			if(!isset(self::$_data_core[$section][$key])) {
				return $key;
			}
			if($wordA === null) {
				return self::$_data_core[$section][$key];	
			}
			if($wordB === null) {
				return sprintf(self::$_data_core[$section][$key], $wordA);	
			}
			return sprintf(self::$_data_core[$section][$key], $wordA, $wordB);
		}
		return '';
	}	


	/* Helpers:   */

	public static function getLang() {
		return self::$_lang;
	}

	public static function getLangCore() {
		return self::$_lang_core;
	}

	public static function getLangName($lang = null) {
		if(empty($lang)) {
			return self::$_lang_name;
		}
		$lang_name = Config::get("lang/all/$lang");
		if(empty($lang_name)) {
			return 'Not defined';
		}
		return $lang_name;
	}

	public static function isDefaultLang() {
		return (self::$_lang == Config::get('lang/default')) ? true : false;
	}

	public static function existsInLang($lang) {
		return array_key_exists($lang, Config::get("lang/all"));
	}

	public static function getRightLang($lang = null) {
		if(empty($lang)) {
			if(!Config::get('lang/default')) {
				ErrorCore::render("Default language pack is not defined.");
			}
			return Config::get('lang/default');
		}
		if(!self::existsInLang($lang)) {
			// Log::save("Error: Language (". $lang .") is not defined.");
			ErrorCore::render("Language (". $lang .") is not defined.");
		}
		return $lang;
	}

}