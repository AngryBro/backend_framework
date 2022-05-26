<?php
include '../app/Controller.php';
include '../app/models/Test.php';

class TestController extends Controller {
	
	public function __construct() {
		return parent::__construct('user','admin');
	}

	public function index() {
		$access = $this->access();
		$test = new Test;
		$params = $test->load($_SESSION['user']);
		if($access) {
			if($_POST['ready']=='ready') {
				$view = new View('test');
			}
			else {
				$view = new View('test_start');
				$params = json_decode($params,true)['name'];
			}
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