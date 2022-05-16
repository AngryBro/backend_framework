<?php

include '../app/View.php';

abstract class Controller {
	
	private $controller;
	
	public function __construct($controller) {
		$this->controller = $controller;
	}
}