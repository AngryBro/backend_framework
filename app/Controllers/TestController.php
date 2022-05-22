<?php
include '../app/Controller.php';
include '../app/models/Test.php';

class TestController extends Controller {
	
	public function index() {
		$view = new View('test');
		$view->render([
			'task_count' => 27
		]);
	}
	
	public function send() {
		//
	}
	
}