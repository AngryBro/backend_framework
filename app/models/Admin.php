<?php

include '../app/Model.php';

class Admin extends Model {
	
	public function unregister($users) {
		$found = false;
		foreach($users as $user) {
			if($this->db_key_exists($user)) {
				$this->db_unset($user);
				$found = true;
			}
		}
		return $found;
	}

	public function register($post) {
		$login = $post['login'];
		$password = $post['password'];
		$password = md5($password);
		$this->db_set($login,['password' => $password]);
		return $this->db_key_exists($login);
	}

	public function getUsers() {
		$users = $this->db_get_keys();
		return $users;
	}

	public function userAccess($user) {
		return 'admin'==$user;
	}

	public function sample() {
		//
	}
	
}

