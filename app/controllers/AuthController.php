<?php
include '../app/Controller.php';
include '../app/models/Auth.php';

class AuthController extends Controller {
	
	
	public function loginView() {
		session_start();
		$auth = new Auth('Users');
		unset($_SESSION['user']);
		$view = new View('login');
		if($auth->submit()) {
			$view->render([
				'alert'=>'alert("Неверные данные")'
			]);
		}
		else {
			$view->render();
		}
	}
	
	public function registerView() {
		$view = new View('register');
		$view->render();
	}
	
	public function login() {
		session_start();
		$auth = new Auth('Users');
		$authed = $auth->login($_POST);
		if($authed) {
			//
		}
		else {
			header('Location: /login');
		}
	}
	
	public function register() {
		$model = new Auth('Users');
		$model->register($_POST);
		echo $_SERVER['HTTP_REFERER'];
	}
	
}