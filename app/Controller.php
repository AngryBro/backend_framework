<?php

include '../app/View.php';

abstract class Controller {
	
	protected $roles;
	
	public function __construct() {
		$n = func_num_args();
		if($n==0) {
			$roles = 'all';
		}
		else {
			$args = func_get_args();
			$roles = [];
			foreach($args as $arg) {
				array_push($roles,$arg);
			}
		}
		$this->roles = $roles;
	}

	protected function access() {
		session_start();
		return ($this->roles=='all')||(in_array($_SESSION['role'],$this->roles));
	}
	protected function deny() {
		return !$this->access();
	}
}