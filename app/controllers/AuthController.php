<?php
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
		$auth = new Auth;
		$auth->logout();
		redirect('/login');
	}

	function silent_logout() {
		$auth = new Auth;
		$auth->logout();
	}
	
}