<?php
include '../app/Controller.php';
// include '../app/models/Sample.php';

class DebugController extends Controller {
	
	public function __construct() {
		return parent::__construct('all');
	}

	public function index() {
		$arr = [3,4,5];
		var_dump($arr);
		unset($arr[1]);
		$arr = array_values($arr);
		var_dump($arr);
	}

	public function debug($param) {
		echo 'Called debug with param = '.$param;
	}
	
}