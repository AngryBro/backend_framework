<?php

class Sample extends Model {
	
	private $sampleDB;

	public function __construct() {
		$this->sampleDB = new DB('Sample');
	}

	public function sample() {
		//
	}
	
}

