<?php

class DB {
	
	private $content;
	private $file;
	private $path;
	
	public function __construct($dbname) {
		$this->path = '../database/'.$dbname.'.json';
		if(filesize($this->path)==0) {
			file_put_contents($this->path,'{}');
		}
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
	public function push_data($data) {
		if(array_key_exists('data',$this->content)) {
			$existing_data = $this->content['data'];
			array_push($existing_data,$data);
			$this->content = [
				'data' => $existing_data
			];
		}
		else {
			$this->content = [
				'data' => [$data]
			];
		}
		$this->file = json_encode($this->content);
		file_put_contents($this->path,$this->file);
	}
	public function get_data() {
		if(isset($this->content['data'])) {
			return $this->content['data'];
		}
		else {
			return [];
		}
	}
	public function exists($key) {
		return array_key_exists($key,$this->content);
	}
}