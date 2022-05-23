<?php
include '../app/Controller.php';
include '../app/models/Test.php';

class TestController extends Controller {
	
	public function index() {
		session_start();
		$authed = isset($_SESSION['user']);
		if($authed) {
			$view = new View('test');
			$view->render([
				'task_count' => 27
			]);
		}
		else {
			$view = new View('page404');
			$view->render();
		}
	}
	
	public function send() {
		//
	}
	
}