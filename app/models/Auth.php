<?php

include '../app/Model.php';

class Auth extends Model {
	
	private $usersDB;

	public function __construct() {
		$this->usersDB = new DB('Users');
	}

	public function login($post) {
		$login = $post['login'];
		$password = $post['password'];
		$user = $this->usersDB->get($login);
		if(password_verify($password,$user['password'])) {
			$_SESSION['user'] = $login;
			$_SESSION['role'] = $user['role'];
			return true;
		}
		return false;
	}

	function logout() {
    	unset($_SESSION['user']);
    	unset($_SESSION['role']);
		unset($_SESSION['saved_answers']);
		session_destroy();
		unset($_COOKIE['PHPSESSID']);
		setcookie('PHPSESSID', '', -1, '/');
	}

}

