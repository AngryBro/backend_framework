<?php

Model::include('User');

class AuthController extends Controller {

	function registerView() {
		$this->accessOnlyFor(['admin']);
		return view('register');
	}

	function register($request) {
		$this->accessOnlyFor(['admin']);
		$request = $request->validate([
			'email' => ['required','maxlen:30','email'],
			'password' => ['minlen:3','required'],
			'kim' => ['required']
		]);
		$auth = new User;
		$response = $auth->register($request);
		return responseJSON(['ok'=>true]);
	}

	function login($post) {
		$auth = new User;
		$request = $post->validate([
			'email' => ['required'],
			'password' => ['required']
		]);
		$authed = $auth->login($request);
		return responseJSON([
			'ok' => true,
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