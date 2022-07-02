<?php

include config('file')['models'].'Test1.php';
include config('file')['models'].'Test2.php';

class DebugController extends Controller {

	public function index() {
		var_dump(gettype(123));
	}
	
}