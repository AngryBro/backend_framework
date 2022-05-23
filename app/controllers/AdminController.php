<?php
include '../app/Controller.php';
include '../app/models/Admin.php';

class AdminController extends Controller {
	
	public function index() {
		session_start();
		$admin = new Admin;
		$access = $admin->userAccess($_SESSION['user']);
		if($access) {
			$view = new View('admin');
			$view->render();
		}
		else {
			$view = new View('page404');
			$view->render();
		}
	}
	
	public function register() {
		session_start();
		$admin = new Admin('Users');
		$access = $admin->userAccess($_SESSION['user']);
		if($access) {
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
		session_start();
		$view = new View('unregister');
		$admin = new Admin('Users');
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