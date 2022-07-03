<?php

Model::include('User');

class AuthController extends Controller {

	function registerView() {
		$this->accessOnlyFor(['admin']);
		return view('register');
	}

	function register($request) {
		$this->accessOnlyFor(['admin']);
		$auth = new User;
		$response = $auth->register($request);
		echo json_encode($response);
	}

	function login($post) {
		$auth = new User;
		$authed = $auth->login($post);
		echo json_encode([
			'authed' => $authed,
			'role' => $authed?$_SESSION['role']:config('access')['default']
		]);
	}

	public function index() {
		return view('login');
	}

	function logout() {
		$auth = new User;
		$auth->logout();
		return redirect('/login');
	}

	function silent_logout() {
		$auth = new User;
		$auth->logout();
	}
	
}