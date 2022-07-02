<?php
include '../app/models/Test.php';

class TestController extends Controller {

	function save($request) {
		$_SESSION['saved_answers'] = $request['json'];
	}

	function getSavedAns() {
		if(!isset($_SESSION['saved_answers'])) {
			$temp = [];
			$temp['i'] = '';
			$test = new Test;
			$data = $test->load($_SESSION['user']);
			$tasks = array_keys($data['files']);
			foreach($tasks as $i) {
				$temp[$i] = '';
			}
			$_SESSION['saved_answers'] = json_encode($temp);
		}
		echo $_SESSION['saved_answers'];
	}

	public function index() {
		return view('test');
	}
	
	function start() {
		$test = new Test;
		$params = ['id' => $test->getKimName($_SESSION['user'])];
		return view('test_start');
	}

	public function send($request) {
		$test = new Test;
		$test->check(json_decode($request['json'],true),$_SESSION['user']);
		return redirect('/slogout');
	}

	function getData() {
		$test = new Test;
		$data = $test->load($_SESSION['user']);
		$tasks = array_keys($data['files']);
		echo json_encode($data);
	}

	function getName() {
		$test = new Test;
		echo $test->getKimName($_SESSION['user']);
	}

	function download($file) {
		$file = explode('-',$file);
		$file = implode('.',$file);
		$test = new Test;
		$test->download($file,$_SESSION['user']);
	}

}