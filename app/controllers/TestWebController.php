<?php

Model::include('Test');
Model::include('Result');

class TestWebController extends Controller {

	function save($request) {
		$_SESSION['saved_answers'] = $request['json'];
	}

	function getSavedAns() {
		if(!isset($_SESSION['saved_answers'])) {
			$temp = [];
			$temp['i'] = '';
			$test = new Test;
			$tasks = $test->kimTaskNumbers($_SESSION['email']);
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
		return view('test_start');
	}

	public function send($request) {
		$result = new Result;
		$test = new Test;
		$email = $_SESSION['email'];
		$kim = $test->kimName($email);
		$answers = json_decode($test->kimTasks($email)['answers'],true);
		$actualAnswers = json_decode($request['json'],true);
		$response = $result->check($email,$kim,$answers,$actualAnswers);
		echo json_encode($response);
	}

	function download($file) {
		$test = new Test;
		$test->download($file,$_SESSION['email']);
	}

}