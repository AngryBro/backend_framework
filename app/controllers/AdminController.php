<?php
include '../app/Controller.php';
include '../app/models/Admin.php';

class AdminController extends Controller {
	
	public function __construct() {
		return parent::__construct('admin');
	}

	public function index() {
		View::show('admin');
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
			$this->abort(404);
		}
		$view = new View('single_result');
		$view->render();
	}

	function getResult($id) {
		$id = (int) $id['json'];
		$admin = new Admin;
		$results = $admin->getResults();
		echo json_encode($results[$id-1]);
	}

	public function results() {
		View::show('results');
	}

	public function register($post) {
		$admin = new Admin;
		$admin->register($post);
	}

	function registerShow() {
		View::show('register');
	}

	public function unregister() {
		View::show('unregister');
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