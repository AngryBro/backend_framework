<?php
include '../app/Controller.php';
include '../app/models/Auth.php';

class AuthController extends Controller {
	
	
	public function loginView() {
		$view = new View('login');
		$view->render();
	}
	
	public function registerView() {
		$view = new View('register');
		$view->render();
	}
	
	public function login() {
		$model = new Auth('Users');
		$login = $model->login($_POST);
		if($login) {
			//
		}	
	}
	
	public function register() {
		$model = new Auth('Users');
		$model->register($_POST);
		echo $_SERVER['HTTP_REFERER'];
	}
	
}