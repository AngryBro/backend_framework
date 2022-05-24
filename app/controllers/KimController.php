<?php
include '../app/Controller.php';
include '../app/models/Kim.php';

class KimController extends Controller {
	
	public function __construct() {
		return parent::__construct('admin');
	}

	public function addkim() {
		if($this->access()) {
			$view = new View('addkim');
			if(empty($_POST)) {
				$view->render();
			}
			else {
				$kim = new Kim;
				$kim->add($_POST,$_FILES);
				$view->render();
			}
		}
		else {
			$view = new View('page404');
			$view->render();
		}
	}

	public function delkim() {
		session_start();
		if($_SESSION['user']!='admin') {
			$view = new View('page404');
			$view->render();
			return;
		}
		$view = new View('delkim');
		if(empty($_POST)) {
			$view->render();
		}
		else {
			$kim = new Kim;
			$kim->delete($_POST);
			$view->render();
		}
	}

	public function index() {
		//	
	}
	
}