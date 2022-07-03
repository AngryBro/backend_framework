<?php

include config('file')['models'].'Test1.php';
include config('file')['models'].'Test2.php';
Model::include('Kim');

class DebugController extends Controller {

	public function index() {
		$db = new DB;
		$png = file_get_contents('../assets/img/test.png');
		$json = json_encode($png);
		var_dump($json);
	}
	
}