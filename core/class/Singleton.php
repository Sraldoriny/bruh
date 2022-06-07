<?php

class Singleton {
	
	protected static	
		$_instance = array(),
		$_instance_name = array();
		
	public static function getInstance($mix = null) {
		$c = get_called_class();
		if(!isset(static::$_instance[$c])) {
			static::$_instance[$c] = new static($mix);
		}
		if(isset($mix)) {
			static::$_instance[$c] = new static($mix);
		}
		return static::$_instance[$c];
	}

	public static function instance($name, $values = null) {
		$c = get_called_class();
		if(!isset(static::$_instance_name[$c][$name])) {
			static::$_instance_name[$c][$name] = new static;
			if(method_exists(static::$_instance_name[$c][$name], "load")) {
				static::$_instance_name[$c][$name]->load($name, $values);
			}
		}
		return static::$_instance_name[$c][$name];
	}

}