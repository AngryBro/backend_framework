<?php
include '../app/Controller.php';
include '../app/models/Test.php';

class TestController extends Controller {
	
	public function __construct() {
		return parent::__construct('user');
	}

	public function index() {
		$access = $this->access();
		if($access) {
			$view = new View('test');
			$test = new Test;
			$params = $test->load($_SESSION['user']);
			$view->render([
				'json' => $params
			]);
		}
		else {
			$view = new View('login');
			$view->render();
		}
	}
	
	public function send() {
		//
	}
	
}