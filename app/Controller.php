<?php

abstract class Controller {
	
	protected $roles;
	public $access;
	
	public function __construct() {
		$n = func_num_args();
		if($n==0) {
			$roles = ['all'];
		}
		else {
			$args = func_get_args();
			$roles = [];
			foreach($args as $arg) {
				array_push($roles,$arg);
			}
		}
		$this->roles = $roles;
		$this->access = in_array('all',$roles)||(array_key_exists('role',$_SESSION)&&in_array($_SESSION['role'],$roles));
	}
}

function abort($code) {
	http_response_code($code);
	View::show('page'.$code);
	exit;
}

function redirect($url) {
	header('Location: '.$url);
}