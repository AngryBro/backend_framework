<?php

include '../app/Model.php';

class Test extends Model {

	private $testDB;

	public function __construct() {
		$this->testDB = new DB('Test');
	}


	public function send() {
		//
	}
	
}

