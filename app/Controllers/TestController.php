<?php
include '../app/Controller.php';
include '../app/models/Test.php';

class TestController extends Controller {
	
	public function view() {
		$view = new View('test');
		$view->render();
	}
	
	public function send() {
		//
	}
	
}