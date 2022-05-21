<?php

class Model {
	
	private $db;
	private $db_file;
	private $db_path;
	
	public function __construct($dbname) {
		$this->db_path = '../database/'.$dbname.'.json';
		$this->db_file = file_get_contents($this->db_path);
		$this->db = json_decode($this->db_file,true);
	}
	
	public function db_set($key,$data) {
		$this->db[$key] = $data;
		$this->db_file = json_encode($this->db);
		file_put_contents($this->db_path,$this->db_file);
	}
	public function db_get($key) {
		return $this->db[$key];
	}
	public function db_unset($key) {
		unset($this->db[$key]);
		$this->db_file = json_encode($this->db);
		file_put_contents($this->db_path,$this->db_file);
	}
	public function db_get_keys() {
		$keys = array_keys($this->db);
		return $keys;
	}
}