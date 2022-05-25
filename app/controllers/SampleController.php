<?php
include '../app/Controller.php';
include '../app/models/Sample.php';

class SampleController extends Controller {
	
	public function __construct() {
		return parent::__construct('all');
	}

	public function index() {
		//	
	}
	
}