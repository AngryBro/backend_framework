<?php

include '../app/Model.php';

class Auth extends Model {
	
	public function __construct() {
		return parent::__construct('Users');
	}

	public function login($post) {
		$login = $post['login'];
		$password = $post['password'];
		$password = md5($password);
		$user = $this->db_get($login);
		if($user['password']==$password) {
			$_SESSION['user'] = $login;
			$_SESSION['role'] = $user['role'];
			return true;
		}
		return false;
	}

}

