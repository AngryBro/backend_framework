<?php
include '../app/Controller.php';
include '../app/models/Admin.php';

class AdminController extends Controller {
	
	public function __construct() {
		return parent::__construct('admin');
	}

	public function index() {
		$this->accessable();
		View::show('admin');
	}
	
	function getResults() {
		$this->accessable();
		$admin = new Admin;
		echo json_encode($admin->getResults());
	}

	function deleteResults($post) {
		$this->accessable();
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
		$this->accessable();
		$view = new View('single_result');
		$view->render();
	}

	function getResult($id) {
		$id = (int) $id['json'];
		$this->accessable();
		$admin = new Admin;
		$results = $admin->getResults();
		echo json_encode($results[$id-1]);
	}

	public function results() {
		$this->accessable();
		View::show('results');
	}

	public function register($post) {
		$this->accessable();
		$admin = new Admin;
		$admin->register($post);
	}

	function registerShow() {
		View::show('register');
	}

	public function unregister() {
		$this->accessable();
		View::show('unregister');
	}

	function getUsers() {
		$this->accessable();
		$admin = new Admin;
		echo json_encode($admin->getUsers());
	}

	function deleteUsers($post) {
		$this->accessable();
		$admin = new Admin;
		$admin->unregister($post);
		echo json_encode($admin->getUsers());
	}
}