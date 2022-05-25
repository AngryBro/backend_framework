<?php

class DB {
	
	private $content;
	private $file;
	private $path;
	
	public function __construct($dbname) {
		$this->path = '../database/'.$dbname.'.json';
		$this->file = file_get_contents($this->path);
		$this->content = json_decode($this->file,true);
	}
	
	public function set($key,$data) {
		$this->content[$key] = $data;
		$this->file = json_encode($this->content);
		file_put_contents($this->path,$this->file);
	}
	public function get($key) {
		return $this->content[$key];
	}
	public function unset($key) {
		unset($this->content[$key]);
		$this->file = json_encode($this->content);
		file_put_contents($this->path,$this->file);
	}
	public function keys() {
		$keys = array_keys($this->content);
		return $keys;
	}
	public function exists($key) {
		return array_key_exists($key,$this->content);
	}
}