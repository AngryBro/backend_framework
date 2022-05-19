<?php
include '../app/Controller.php';
include '../app/models/Auth.php';

class AuthController extends Controller {
	
	
	public function loginView() {
		session_start();
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
		$authed = $auth->login($_POST);
		if($authed) {
			if($_SESSION['user']=='admin') {
				header('Location: /admin');
			}
			else {
				header('Location: /test');
			}
		}
		else {
			header('Location: /login');
		}
	}
	
	public function register() {
		$auth = new Auth('Users');
		$auth->register($_POST);
	}
	
}