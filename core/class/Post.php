<?php

/**
 * POST
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.23
 */

class Post {

	public static function get($var, $default_data = null) {
		if(isset($_POST[$var])) {
			return $_POST[$var];
		}
		return $default_data;
	}

	public static function getChecked($var, $data = null) {
		if(isset($_POST[$var])) {
			return 'checked';
		}
		if($data) {
			return 'checked';
		}
		return '';
	}

	public static function exists($var, $get_number = false) {
		if($get_number) {
			return (isset($_POST[$var])) ? 1 : 0;
		}
		return isset($_POST[$var]);
	}

	public static function sanitize(array $items) {
		$new = array();
		foreach($items as $key => $value) {
			if($value['sanitize']) {
				$_POST[$key] = sanitize($value['sanitize'], $_POST[$key]);
			}
		}
		return;
	}

	public static function magicStripSlashes() {
		if(empty($_POST)) {
			return;
		}
		if (get_magic_quotes_gpc()) {
			$process = array(&$_POST);
			while (list($key, $val) = each($process)) {
				foreach ($val as $k => $v) {
					unset($process[$key][$k]);
					if (is_array($v)) {
						$process[$key][stripslashes($k)] = $v;
						$process[] = &$process[$key][stripslashes($k)];
					} else {
						$process[$key][stripslashes($k)] = stripslashes($v);
					}
				}
			}
			unset($process);
		}
		return;
	}

}