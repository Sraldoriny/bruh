<?php

/**
 * NOTIFY
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.15
 */

class Notify {

	const
		SESSION_NAME = "notify";

	private static
		$_type = array(
			'success',
			'warning',
			'danger',
			'info'
		);

	private static
		$_template = array(
			"default" => '
				<div class="alert alert-%type%" role="alert">
					<span>%message%</span>
				</div>',
			"solid_left" => '
				<div class="alert bg-%type% alert-styled-left">
            		%message%
        		</div>',
        );

	public static function set($type = 'danger', $message) {
		if(in_array($type, self::$_type)) {
			Session::add(Config::get('session/notify_name', self::SESSION_NAME), array($type, $message));
			return true;
		}
		return false;
	}

	public static function get($style = "default") {
		$html = null;
		$notify_name = Config::get('session/notify_name', self::SESSION_NAME);
		if(Session::exists($notify_name)) {
			foreach(Session::get($notify_name) as $data) {
				list($type, $message) = $data;
				if(isset(self::$_template[$style])) {
					$template = self::$_template[$style];
				}
				else {
					$template = self::$_template["default"];
				}
				$template = str_replace('%type%', $type , $template);
				$html .= str_replace('%message%', $message, $template);
			}
			Session::delete($notify_name);
		}
		return $html;
	}

	public static function show($type, $message, $style = "default") {
		$html = str_replace('%type%', $type , self::$_template[$style]);
		return str_replace('%message%', $message, $html);
	}

}
