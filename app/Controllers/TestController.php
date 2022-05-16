<?php
include '../app/Controller.php';
include '../app/models/Test.php';

class TestController extends Controller {
	
	public function view($params) {
		$view = new View('test');
		$view->render($params);
	}
	
	public function send() {
		//
	}
	
}