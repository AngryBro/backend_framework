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
		session_start();
		$auth = new Auth('Users');
		if($auth->submit()) {
			echo 'submit';
		}
		else {
			echo 'show';
		}
	}
	
	public function register() {
		$model = new Auth('Users');
		$model->register($_POST);
		echo $_SERVER['HTTP_REFERER'];
	}
	
}