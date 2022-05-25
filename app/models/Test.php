<?php

include '../app/Model.php';

class Test extends Model {

	private $testDB;
	private $kimsDB;
	private $usersDB;

	public function __construct() {
		$this->testDB = new DB('Test');
		$this->kimsDB = new DB('Kims');
		$this->usersDB = new DB('Users');
	}

	public function load($user) {
		$kim = $this->usersDB->get($user)['kim'];
		$kim = $this->kimsDB->get($kim);
		$params = [
			'task_count' => $kim['task_count'],
			'files' => $kim['files']
		];
		$params = json_encode($params);
		return $params;
	}

	public function send() {
		//
	}
	
}

