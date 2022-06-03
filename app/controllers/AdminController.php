<?php
include '../app/Controller.php';
include '../app/models/Admin.php';

class AdminController extends Controller {
	
	public function __construct() {
		return parent::__construct('admin');
	}

	public function index() {
		$access = $this->access();
		if($access) {
			$view = new View('admin');
			$view->render();
		}
		else {
			$view = new View('page404');
			$view->render();
		}
	}
	
	function getResults() {
		$this->accessable();
		$admin = new Admin;
		echo json_encode($admin->getResults());
	}

	function deleteResults() {
		$this->accessable();
		$admin = new Admin;
		$admin->deleteResults($_POST);
		echo json_encode($admin->getResults());
	}

	function single_result($id) {
		if(!$this->access()) {
			$view = new View('page404');
			return;
		}
		$admin = new Admin;
		$view = new View('single_result');
		$params = [
			'id' => $id,
			'json' => json_encode($admin->getResults()[$id-1])
		];
		$view->render($params);
	}

	public function results() {
		$this->accessable();
		View::show('results');
	}

	public function register() {
		$access = $this->access();
		if($access) {
			$admin = new Admin;
			$view = new View('register');
			if(empty($_POST)) {
				$view->render();
			}
			else {
				$registered = $admin->register($_POST);
				$msg = $registered?'"Успешно"':'"Ошибка"';
				$view->render([
					'alert' => '<script>alert('.$msg.')</script>'
				]);
			}
		}
		else {
			$view = new View('page404');
			$view->render();
		}
	}

	public function unregister() {
		if(!$this->access()) {
			$view = new View('page404');
			$view->render();
			return;
		}
		$view = new View('unregister');
		$admin = new Admin;
		if(empty($_POST)) {
			$users = $admin->getUsers();
			$view->render([
				'users' => $users
			]);
		}
		else {
			$json = $_POST['json'];
			$usersArr = json_decode($json,false);
			$success = $admin->unregister($usersArr);
			$users = $admin->getUsers();
			$msg = $success?'"Успешно"':'"Ошибка"';
			$view->render([
				'alert' => '<script>alert('.$msg.')</script>',
				'users' => $users
			]);
		}
	}
}