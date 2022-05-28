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
		$password = md5($password);
		$this->usersDB->set($login,[
			'password' => $password,
			'role' => 'user',
			'kim' => $post['kim']
		]);
		return $this->usersDB->exists($login);
	}

	public function getUsers() {
		$users = $this->usersDB->keys();
		return $users;
	}

	public function getResults() {
		$results = $this->testDB->get_data();
		return $results;
	}

	public function sample() {
		//
	}
	
}

