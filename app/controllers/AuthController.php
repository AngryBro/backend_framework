<?php
include '../app/Controller.php';
include '../app/models/Auth.php';

class AuthController extends Controller {
	
	function authentificate() {
		$auth = new Auth;
		$authed = $auth->login($_POST);
		echo json_encode([
			'authed' => $authed,
			'role' => $authed?$_SESSION['role']:'unknown'
		]);
	}

	public function login() {
		View::show('login');
	}
	
}