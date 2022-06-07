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
 * @version    0.21
 */

class ModuleCore {

	public static function start($module = null) {
		if(empty($module)) {
			$file = __PROJECTPATH__ . Config::get("path/modules") . URL::getModule() . ".php";
		}

		$file = __PROJECTPATH__ . Config::get("path/modules") . $module . ".php";

		if(!file_exists($file)) {
			// ErrorCore::render("The File of module ($module) doesn't exist.");
			// Log::save("Error404: ". implode("/", URL::getURLData()));
			Redirect::to(404);
		}

		require_once $file;

		$moduleName = "Module_" . $module;
		$obj = new $moduleName();
		$obj->start();

		return true;
	}

}