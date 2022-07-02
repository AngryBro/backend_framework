<?php

Model::include('Admin');
Model::include('User');

class AdminController extends Controller {

	public function index() {
		return view('admin');
	}
	
	function getResults() {
		$admin = new Admin;
		echo json_encode($admin->getResults());
	}

	function deleteResults($post) {
		$admin = new Admin;
		$admin->deleteResults($post);
		echo json_encode($admin->getResults());
	}

	function single_result($id) {
		$admin = new Admin;
		$results = $admin->getResults();
		if(($id<=0)||($id>count($results))) {
			abort(404);
		}
		return view('single_result');
	}

	function getResult($id) {
		$id = (int) $id['json'];
		$admin = new Admin;
		$results = $admin->getResults();
		echo json_encode($results[$id-1]);
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

	function getUsers() {
		$admin = new Admin;
		echo json_encode($admin->getUsers());
	}

	function deleteUsers($post) {
		$admin = new Admin;
		$admin->unregister($post);
		echo json_encode($admin->getUsers());
	}
}