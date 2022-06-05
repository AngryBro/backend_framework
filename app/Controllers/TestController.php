<?php
include '../app/Controller.php';
include '../app/models/Test.php';

class TestController extends Controller {
	
	public function __construct() {
		return parent::__construct('user','admin');
	}

	public function index() {
		$this->accessable();
		View::show('test');
	}
	
	public function send($request) {
		$this->accessable();
		$test = new Test;
		$test->check(json_decode($request['json'],true),$_SESSION['user']);
	}

	function getData() {
		$this->accessable();
		$test = new Test;
		echo $test->load($_SESSION['user']);
	}

	function getName() {
		$this->accessable();
		$test = new Test;
		echo $test->getKimName($_SESSION['user']);
	}

}