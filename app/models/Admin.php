<?php

include '../app/Model.php';

class Admin extends Model {

	private $usersDB;
	private $testDB;

	public function __construct() {
		$this->usersDB = new DB('Users');
		$this->testDB = new DB('Test');
	}

	public function unregister($users) {
		$users = json_decode($users['json'],false);
		$found = false;
		foreach($users as $user) {
			if($this->usersDB->exists($user)) {
				$this->usersDB->unset($user);
				$found = true;
			}
		}
		return $found;
	}

	public function register($post) {
		$login = $post['login'];
		$password = $post['password'];
		$password = password_hash($password,PASSWORD_DEFAULT);
		$this->usersDB->set($login,[
			'password' => $password,
			'role' => 'user',
			'kim' => $post['kim']
		]);
		return $this->usersDB->exists($login);
	}

	public function getUsers() {
		$users = array_diff($this->usersDB->keys(),['admin','user']);
		return $users;
	}

	public function getResults() {
		$results = $this->testDB->get_data();
		return $results;
	}

	public function deleteResults($post) {
		if(!isset($post['json'])) {
			return 'error';
		}
		$ids = json_decode($post['json'],false);
		$this->testDB->delete_data($ids);
	}

	public function sample() {
		//
	}
	
}

