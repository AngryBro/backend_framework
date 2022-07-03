<?php

Model::include('User');

class AdminController extends Controller {

	public function index() {
		return view('admin');
	}


	function single_result($id) {
		return view('single_result');
	}

	public function results() {
		return view('results');
	}

	public function unregisterView() {
		return view('unregister');
	}

	function unregister($request) {
		$emails = json_decode($request['json'],false);
		$auth = new User;
		$response = $auth->unregister($emails);
		echo json_encode($response);
	}
}