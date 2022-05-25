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
			$_SESSION['user'] = $login;
			$_SESSION['role'] = $user['role'];
			return true;
		}
		return false;
	}

}

