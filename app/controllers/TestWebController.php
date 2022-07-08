<?php

Model::include('Test');
Model::include('Result');

class TestWebController extends Controller {

	function save($request) {
		$_SESSION['saved_answers'] = $request->rawData()['json'];
	}

	function getSavedAns() {
		if(!isset($_SESSION['saved_answers'])) {
			$temp = [];
			$temp['i'] = '';
			$test = new Test;
			$tasks = $test->kimTaskNumbers($_SESSION['email']);
			if($tasks===null) {
				return responseCode(404);
			}
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
		$kimModel = new Kim;
		$result = new Result;
		$test = new Test;
		$email = $_SESSION['email'];
		$kim = $test->kimName($email);
		if($kimModel->notExists($kim)) {
			return responseCode(204);
		}
		$tasks = $test->kimTasks($email);
		$answers = json_decode(isset($tasks['answers'])?$tasks['answers']:[],true);
		$actualAnswers = $request->json();
		$response = $result->check($email,$kim,$answers,$actualAnswers);
		return responseJSON(['ok' => $response]);
	}

	function download($file) {
		$test = new Test;
		$test->download($file,$_SESSION['email']);
	}

}