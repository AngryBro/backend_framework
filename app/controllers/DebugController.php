<?php

class DebugController extends Controller {
	
	public function __construct() {
		return parent::__construct('all');
	}

	public function index() {
		$dbcon = pg_connect('host=localhost port=5432 dbname=InfTest');
		var_dump($dbcon);
	}
	
}