<?php
require '../Controller.php';

class TestController extends Controller {
	public function ShowTest() {
		echo $this->params;
	}
}