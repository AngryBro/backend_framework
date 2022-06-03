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

	function deleteResults() {
		$this->accessable();
		$admin = new Admin;
		$admin->deleteResults($_POST);
		echo json_encode($admin->getResults());
	}

	function single_result($id) {
		$id = $id[0];
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
		$this->accessable();
		View::show('unregister');
	}

	function getUsers() {
		$this->accessable();
		$admin = new Admin;
		echo json_encode($admin->getUsers());
	}

	function deleteUsers() {
		$this->accessable();
		$admin = new Admin;
		$admin->unregister($_POST);
		echo json_encode($admin->getUsers());
	}
}