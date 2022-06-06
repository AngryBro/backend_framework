<?php
include '../app/Controller.php';

class DebugController extends Controller {
	
	public function __construct() {
		return parent::__construct('all');
	}

	public function index($params) {
		$params = ['params' => $params];
		$view = new View('debug');
		$view->render($params);
		var_dump($_SERVER['REQUEST_URI']);
	}

	function download() {
		$file = '../storage/graph.pdf';
		header('Content-Disposition: attachment; filename="graph.pdf"');
		readfile($file);
	}
	
}