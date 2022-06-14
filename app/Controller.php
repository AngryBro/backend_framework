<?php

include '../app/View.php';

abstract class Controller {
	
	protected $roles;
	
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
		if(!(in_array('all',$roles)||(array_key_exists('role',$_SESSION)&&in_array($_SESSION['role'],$roles)))) {
			http_response_code(403);
			View::show('page403');
			exit;
		}
	}

	protected function abort($error) {
		http_response_code($error);
		View::show('page'.$error);
		exit;
	}

	protected function redirect($url) {
		header('Location: '.$url);
	}
}