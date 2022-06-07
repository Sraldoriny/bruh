<?php

/**
 * MODULE
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

abstract class Module {

	protected static
		$_moduleName;

	public function __construct() {
		static::$_moduleName = substr(get_class($this), 7);
	}

	public function noDataFromURL() {
		if(URL::isData()) {
			Redirect::to(404);	
		}
	}

	public function getModuleName() {
		return static::$_moduleName;
	}

	public static function getData($id) {
		return URL::getData($id + 1);
	}
}