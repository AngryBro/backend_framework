<?php

include '../app/Model.php';

class Auth extends Model {
	
	public function submit() {
		$submit = explode('/',$_SERVER['REQUEST_URI']);
		$submit = array_pop($submit);
		return $submit == 'submit';
	}
	
	public function login($post) {
		$login = $post['login'];
		$password = $post['password'];
		$password = md5($password);
		if($this->db_get($login)['password']==$password) {
			$_SESSION['role_token'] = $login=='admin'?
				$this->role_token['admin']:
				$this->role_token['user'];
			return true;
		}
		return false;
	}
	public function register($post) {
		$login = $post['login'];
		$password = $post['password'];
		$password = md5($password);
		$this->db_set($login,['password' => $password]);
	}
	
}

