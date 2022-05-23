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
			$auth = new Auth;
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
	
}