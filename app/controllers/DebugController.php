<?php
include '../app/Controller.php';
// include '../app/models/Sample.php';

class DebugController extends Controller {
	
	public function __construct() {
		return parent::__construct('all');
	}

	public function index() {
		$view = new View('debug');
		$view->render();
	}

	function post() {
		//
	}
	
}