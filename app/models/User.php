<?php

class User extends Model {
	
	public function __construct() {
		$this->table = 'users';
	}

	public function login($post) {
		$email = $post['email'];
		$password = $post['password'];
		$response = $this->query()
		->select(['password_hash','role'])
		->where(['email' => $email])
		->send();
		if($response['empty']) {
			return false;
		}
		$data = $response['data'][0];
		if(password_verify($password,$data['password_hash'])) {
			$_SESSION['email'] = $email;
			$_SESSION['role'] = $data['role'];
			return true;
		}
		return false;
	}

	function logout() {
    	unset($_SESSION['email']);
    	unset($_SESSION['role']);
		unset($_SESSION['saved_answers']);
		session_destroy();
		unset($_COOKIE['PHPSESSID']);
		setcookie('PHPSESSID', '', -1, '/');
	}

	function register($request) {
		//$this->accessOnlyFor(['admin']);
		$email = $request['email'];
		$password = $request['password'];
		$role = 'user';
		$kim = $request['kim'];
		if((empty($email))||(empty($password))||empty($kim)) {
			return false;
		}
		$result = $this->query()
		->select(['email'])
		->where(["email" => $email])
		->send();
		if(!empty($result)) {
			$this->query()
			->delete()
			->where(["email" => $email])
			->send();
		}
		$response = $this->query()
		->insert([
			'email' => $email,
			'password_hash' => password_hash($password,PASSWORD_DEFAULT),
			'kim' => $kim,
			'role' => $role
		])->send();
		return $response['ok'];
	}

	function unregister($emails) {
		$response = $this->query()
		->delete()
		->whereIn([
			'email' => $emails
		])
		->whereNot(['email' => 'admin'])
		->send();
		return $response;
	}

}

