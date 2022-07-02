<?php

class AssetsController extends Controller {
	
	private $assets;

	function __construct() {
		$this->assets = config('file')['assets'];
	}

	public function js($script) {
		$file = $this->assets['js'].$script.'.js';
		if(file_exists($file)) {
			require $file;
		}
		else {
			abort(404);
		}
	}

	public function css($style) {
		$file = $this->assets['css'].$style.'.css';
		if(file_exists($file)) {
			require $file;
		}
		else {
			abort(404);
		}
	}

	public function img($image) {
		$file = $this->assets['img'].$image['name'].'.'.$image['extension'];
		if(file_exists($file)) {
			require $file;
		}
		else {
			abort(404);
		}
	}
	
}