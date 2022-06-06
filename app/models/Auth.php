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
		$password = md5($password);
		$user = $this->usersDB->get($login);
		if($user['password']==$password) {
			session_start();
			$_SESSION['user'] = $login;
			$_SESSION['role'] = $user['role'];
			return true;
		}
		return false;
	}

	function logout() {
		session_start();
    	unset($_SESSION['user']);
    	unset($_SESSION['role']);
		session_destroy();
		unset($_COOKIE['PHPSESSID']);
		setcookie('PHPSESSID', null, -1, '/');
	}

}

