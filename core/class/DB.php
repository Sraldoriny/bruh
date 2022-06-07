<?php

/**
 * DB 
 *
 * This library is licensed software; you can't redistribute it and/or
 * modify it without the permission.
 *
 * @author     Nixo
 * @package    Core
 * @copyright  DATKO.TECH & AWEBIN.SK (c) 2014 - 2024
 * @license    kruzok-cvc
 * @version    0.37
 */

class DB {
	
	private static $_instance = null;
	private
		$_pdo,
		$_error = false,
		$_results,
		$_lastInsertId,
		$_count = 0;

	private
		$_fetch_types = array(
			"object" => PDO::FETCH_OBJ,
			"array" => PDO::FETCH_ASSOC,
			"column" => PDO::FETCH_COLUMN
		);


	private function __construct() {
		$port = '';
		if(Config::exists('mysql/port')) {
			$port = ';port='. Config::get('mysql/port');
		}
		try {
			$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . $port .';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			/*
			  . ';charset=utf8'
			  , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
			  $this->_pdo->exec('SET NAMES utf8');
			*/
		} catch(PDOException $e) {
			ErrorCore::render("Can't connect to database.");
		}
	}
	
	public static function getInstance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function query($sql, $params = array(), $fetch_type = "object") {
		$this->_error = false;
		if(!in_array($fetch_type, $this->_fetch_types))
			$fetch_type = "object";

		if($query_pdo = $this->_pdo->prepare($sql)) {
			$x = 1;
			if(!is_array($params)) {
				$params = array($params);
			}
			if(count($params)) {
				foreach($params as $param) {
					$query_pdo->bindValue($x, $param);
					$x++;
				}
			}
			if($query_pdo->execute()) {
				$this->_results = $query_pdo->fetchAll($this->_fetch_types[$fetch_type]);
				$this->_lastInsertId = $this->_pdo->lastInsertId();
				$this->_count = $query_pdo->rowCount();
				$this->_error = false;
			} else {
				$this->_results = array();
				$this->_lastInsertId = null;
				$this->_count = 0;
				$this->_error = true;
			}
			return $this;
		}
	}
	
	private function action($action, $table, $where = array()) {
		if(count($where) === 3) {
			$operators = array('=', '<', '>', '>=', '<=');
			
			$field      = $where[0];
			$operator   = $where[1];
			$value      = $where[2];
			
			if(in_array($operator, $operators)) {
				$sql = "{$action} FROM " . Config::get('mysql/prefix') . "{$table} WHERE {$field} {$operator} ?";
				
				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}
			}
		}
		return false;
	}
	
	public function column($table, $column) {
		return $this->query("SELECT `{$column}` FROM `". Config::get('mysql/prefix') . $table ."`;", null, "column");
	}

	public function get($table, $where) {
		return $this->action('SELECT *', $table, $where);
	}

	public function delete($table, $where) {
		return $this->action('DELETE', $table, $where);
	}

	public function insert($table, $fields) {
		$keys = array_keys($fields);
		$values = null;
		$x = 1;
		
		foreach($fields as $field) {
			$values .= '?';
			if($x < count($fields)) {
				$values .= ', ';
			}
			$x++;
		}
		
		$sql = "INSERT INTO " . Config::get('mysql/prefix') . $table . " ( `" . implode('`, `', $keys) . "`) VALUES ({$values})";

		if(!$this->query($sql, $fields)->error()) {
			return true;
		}		
		return false;
	}

	public function update($table, $id, $fields) {
		$set = null;
		
		$x = 1;
		foreach($fields as $name => $value) {
			$set .= "`{$name}` = ?, ";
			$x++;
		}
		$set = substr($set, 0, -2);
		
		$sql = "UPDATE " . Config::get('mysql/prefix') . $table . " SET {$set} WHERE id = ?"; 
		$fields = array_merge($fields, array("id" => $id));

		if(!$this->query($sql, $fields)->error()) {
			return true;
		}
		return false;	
	}
		

	public function results() {
		return $this->_results;
	}

	public function all() {
		return $this->_results;
	}

	public function first() {
		return $this->_results[0];
	}
	
	public function lastInsertId() {
		return $this->_lastInsertId;
	}

	public function error() {
		return $this->_error;
	}
	
	public function count() {
		return $this->_count;
	}
	
}
