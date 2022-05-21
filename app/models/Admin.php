<?php

include '../app/Model.php';

class Admin extends Model {
	
	public function unregister($users) {
		foreach($users as $user) {
			$this->db_unset($user);
		}
	}

	public function getUsers() {
		$users = $this->db_get_keys();
		return $users;
	}

	public function sample() {
		//
	}
	
}

