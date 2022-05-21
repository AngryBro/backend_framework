<?php

class View {
	
	private $path;
	
	public function __construct($viewname) {
		$this->path = '../resources/views/'.$viewname.'.php';
	}
	
	public function render() {
		if(func_num_args()) {
			$arg = func_get_args()[0];
			extract($arg);
		}
		require $this->path;
	}
}