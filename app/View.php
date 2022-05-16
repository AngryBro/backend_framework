<?php

class View {
	
	private $path;
	
	public function __construct($viewname) {
		$this->path = '../resources/views/'.$viewname.'.php';
	}
	
	public function render($params = []) {
		extract($params);
		require $this->path;
	}
}