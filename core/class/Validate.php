<?php

/**
 * VALIDATE
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.53
 */

class Validate {
	
	private $_passed = false,
			$_errors = array();
		
	public function check($source, $items = array()) {
		foreach($items as $item => $rules) {

			$name = ($rules['name']) ? $rules['name'] : _e($item);

			foreach($rules as $rule => $rule_value) {
			
				$value = $source[$item];

				if($rule === 'required' && empty($value)) {
					$this->addError(array("REQUIRED", $name));
				}
				else if(!empty($value)) {
					switch($rule) {
						case 'min':
							if(mb_strlen(trim($value)) < $rule_value) {
								$this->AddError(array("MIN_CHAR", $name, $rule_value));
							}
							break;
						case 'max':
							if(mb_strlen(trim($value)) > $rule_value) {
								$this->AddError(array("MAX_CHAR", $name, $rule_value));
							}
							break;
						case 'matches':
							if($value != $source[$rule_value]) {
								$name_match = (empty($items[$rule_value]['name'])) ? $rule_value : $items[$rule_value]['name'];
								$this->AddError(array("MATCHES", $name_match, $name));
							}
							break;
						case 'unique':
							list($table, $column) = explode("/", $rule_value);
							$check = DB::getInstance()->get($table, array($column, '=', $value));
							if($check === false) {
								$this->AddError(array("DB_ERROR", $value));
							}
							else if($check->count()) { 
								$this->AddError(array("UNIQUE", $value));
							}
							break;
						case 'preg_match':
							if(!preg_match($rule_value, $value)) {
								$this->AddError(array("PREG_MATCH", $name));
							}
							break;
						case 'decimal':
							if(!preg_match("/^[0-9]*$/", $value)) {
								$this->AddError(array("DECIMAL", $name));
							}
							break;
						case 'type':
							switch($rule_value) {
								case 'email':
									if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
										$this->AddError(array("INCORRECT_EMAIL", $name));
									}
									break;
								case 'date-cz':
									$date = str_replace(" ", "", $value);
									if (!preg_match('/^([0-9]{1,2}).([0-9]{1,2}).([0-9]{4})$/', $date, $match)) {
										$this->AddError(array("INCORRECT_DATE", $name));
										break;
									}
									$d = (int) $match[1];
									$m = (int) $match[2];
									$y = (int) $match[3];
									if (!checkdate($m, $d, $y)) {
										$this->AddError(array("INCORRECT_DATE", $name));
										break;
									}
									break;

							}
							break;
					}
				}
			}
		}
		
		if(empty($this->_errors)) {
			$this->_passed = true;
		}
		
		return $this;
	}

	public function addError($error) {
		$this->_errors[] = $error;
	}
	
	public function errors() {
		return $this->_errors;
	}

	public function htmlErrors() {
		if(is_array($this->_errors)) {
			$data = array();
			foreach($this->_errors as $item) {
				$data[] = Lang::getError($item);
			}
			return nl2br(implode(PHP_EOL, $data));
		}
		return false;
	}

	public function langError($error) {
		return Lang::getError($error);
	}
	
	public function passed() {
		return $this->_passed;
	}
}
