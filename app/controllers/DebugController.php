<?php
include '../app/Controller.php';
// include '../app/models/Sample.php';

class DebugController extends Controller {
	
	public function __construct() {
		return parent::__construct('all');
	}

	public function index() {
		var_dump($_POST);
	}

	public function debug($param) {
		echo 'Called debug with param = '.$param;
	}
	
}