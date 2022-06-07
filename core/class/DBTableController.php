<?php

/**
 * DBTABLECONTROLLER
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2019
 * @license    intranet-one
 * @version    0.46
 */

abstract class DBTableController {
	
	protected
		/* table name without prefix */
		$_table;

	protected
		$_data = array(),
		$_lastInsertedId,
		$_count = 0,
		$_error = false,
		$DB;
			
	protected static	
		$_instance = array(),
		$_instance_name = array();

	public function __construct($mix = null) {
		$this->DB = DB::getInstance();
		if(isset($mix)) {
			if(is_array($mix)) {
				$this->loadData($mix);
				return;
			}
			if(is_numeric($mix)) {
				$this->loadData(array(
					"query" => "SELECT * FROM __table__ WHERE id = ?;",
					"values" => array((int) $mix),
					"first" => true
				));
				return;
			}
		}
		return;
	}

	public function loadData($mix = null) {
		/* (array) mix: query, values, first, fetch_type
		 * Tablename use: __table__ 
		 */
		$first = false;
		if(isset($mix)) {
			if(is_array($mix)) {
				$data = $mix;
				$query = $data['query'];
				if(!empty($query)) {
					$query = str_replace("__table__", $this->getFullTableName(), $query);

					if(isset($data['values']))
						$values = $data['values'];
					if(isset($data['first']))
						$first = $data['first'];
					if(isset($data['fetch_type'])) {
						$fetch_type = $data['fetch_type'];
						$this->DB->query($query, $values, $fetch_type);
					}
					else {
						$this->DB->query($query, $values);
					}
				}
			}
			else {
				return;
			}
		}
		else {
			$this->DB->query("SELECT * FROM ". $this->getFullTableName() .";");
		}

		if($first) {
			$this->_data = $this->DB->first();
		}
		else {
			$this->_data = $this->DB->all();
		}

		$this->_count = $this->DB->count();
		$this->_error = $this->DB->error();
		return;
	}

	public function loadColumn($column, $value = null) {
		if(isset($value)) {
			$this->loadData(array(
				"query" => "SELECT * FROM __table__ WHERE `{$column}` = ?;",
				"values" => array($value)
			));
		}
		else {
			$this->loadData(array(
				"query" => "SELECT {$column} FROM __table__;",
			));
		}
		return;
	}

	public function loadAll() {
		$this->loadData(array(
			"query" => "SELECT * FROM __table__;",
		));
		return $this;
	}


	public function load($name) {
		return;
	}

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
			static::$_instance_name[$c][$name]->load($name, $values);
		}
		return static::$_instance_name[$c][$name];
	}

	public function getTableName() {
		return $this->_table;
	}

	public function getFullTableName() {
		return Config::get("mysql/prefix") . $this->_table;
	}

	public function insert($data) {
		$this->DB->insert($this->_table, $data);
		$this->_error = $this->DB->error();
		$this->_lastInsertedId = $this->DB->lastInsertId();
		return !$this->_error;
	}

	public function lastInsertedId() {
		return $this->_lastInsertedId;
	}

	public function update($data, $id = null) {
		if(isset($id)) {
			$this->DB->update($this->_table, $id, $data);
		}
		else {
			$this->DB->update($this->_table, $this->_data->id, $data);
		}
		$this->_error = $this->DB->error();
		return !$this->_error;
	}

	public function delete($id = null) {
		if(isset($id)) {
			$this->DB->delete($this->_table, array("id", "=", $id));	
		}
		else {
			$this->DB->delete($this->_table, array("id", "=", $this->_data->id));
		}
		$this->_error = $this->DB->error();
		return !$this->_error;
	}
	
	public function option($value, $column_name = "name") {
		$html = '';
		foreach ($this->_data as $row) {
			$selected = ($value == $row->id) ? 'selected' : '';
			$html .= '<option value="' . _e($row->id) . '" ' . $selected . '>'.  _e($row->{$column_name}) .'</option>'."\n";
		}
		return $html;
	}
	
	public function data($index = null) {
		if(isset($index)) {
			return $this->_data[$index];
		}
		return $this->_data;
	}

	public function putData($data) {
		$this->_data = $data;
		return;
	}

	public function exists() {
		return !empty($this->_data);
	}	

	public function error() {
		return $this->_error;
	}	

	public function count() {
		return $this->_count;
	}

	public function truncate()	{
		$table = $this->getFullTableName();
		$this->DB->query("TRUNCATE TABLE {$table};");
		$this->_error = $this->DB->error();
		return !$this->_error;		
	}

	public function cleanData() {
		$this->_data = array();
		return $this;
	}

	public function total($column = "id") {
		$table = $this->getFullTableName();
		return $this->DB->query("SELECT COUNT({$column}) as total FROM {$table};")->first()->total;
	}

	public function getColumns() {
		$this->loadData(array(
			"query" => "SHOW columns FROM __table__;",
		));
		$names = array();
		foreach($this->data() as $row)  {
			$names[] = $row->Field;
		}
		return $names;
	}

}