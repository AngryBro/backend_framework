<?php

include '../app/Model.php';

class Auth extends Model {
	
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

