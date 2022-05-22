<?php
include '../app/Controller.php';
include '../app/models/Auth.php';

class AuthController extends Controller {
	
	public function login() {
		if(empty($_POST)) {
			$view = new View('login');
			$view->render();
		}
		else {
			session_start();
			$auth = new Auth('Users');
			$authed = $auth->login($_POST);
			if($authed) {
				header('Location: /'.($_SESSION['user']=='admin'?'admin':'test'));
			}
			else {
				$view = new View('login');
				$view->render([
					'alert' => '<script>alert("Неверные данные")</script>'
				]);
			}
		}
	}
	
	public function register() {
		$view = new View('register');
		if(empty($_POST)) {
			$view->render();
		}
		else {
			$auth = new Auth('Users');
			$registered = $auth->register($_POST);
			$msg = $registered?'"Успешно"':'"Ошибка"';
			$view->render([
				'alert' => '<script>alert('.$msg.')</script>'
			]);
		}
	}
	
}