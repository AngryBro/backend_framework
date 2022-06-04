<?php
include '../app/Controller.php';
include '../app/models/Auth.php';

class AuthController extends Controller {
	
	function authentificate($post) {
		$auth = new Auth;
		$authed = $auth->login($post);
		echo json_encode([
			'authed' => $authed,
			'role' => $authed?$_SESSION['role']:'unknown'
		]);
	}

	public function index() {
		View::show('login');
	}

	function logout() {
		session_start();
    	unset($_SESSION['user']);
    	unset($_SESSION['role']);
		$this->redirect('/login');
	}
	
}