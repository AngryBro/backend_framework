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
			if(empty($_POST)) {
				$view = new View('test_start');
				$params = json_decode($params,true)['name'];
			}
			else {
				if(isset($_POST['ready'])) {
					$view = new View('test');
				}
				if(isset($_POST['json'])) {
					$result = json_decode($_POST['json'],true);
					$test->check($result,$_SESSION['user']);
					$view = new View('test_end');
				}
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