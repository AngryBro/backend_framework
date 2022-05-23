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
		if($this->db_get($login)['password']==$password) {
			$_SESSION['user'] = $login;
			return true;
		}
		return false;
	}

}

