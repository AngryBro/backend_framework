<?php
include '../app/Controller.php';
include '../app/models/Test.php';

class TestController extends Controller {
	
	public function index() {
		$view = new View('test');
		$view->render([
			'test' => 'TESTING'
		]);
	}
	
	public function send() {
		//
	}
	
}