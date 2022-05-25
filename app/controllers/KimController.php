<?php
include '../app/Controller.php';
include '../app/models/Kim.php';

class KimController extends Controller {
	
	public function __construct() {
		return parent::__construct('admin');
	}

	public function addkim() {
		$params = [
			'alert' => ''
		];
		if($this->access()) {
			$view = new View('addkim');
			if(!empty($_POST)) {
				$kim = new Kim;
				$msg = $kim->add($_POST,$_FILES);
				$alert = '<script>alert("'.$msg.'")</script>';
				$params = [
					'alert' => $alert
				];
			}
		}
		else {
			$view = new View('page404');
		}
		$view->render($params);
	}

	public function delkim() {
		if($this->access()) {
		$kim = new Kim;
		$view = new View('delkim');
			if(!empty($_POST)) {
				$kim->delete($_POST);
			}
		}
		else {
			$view = new View('page404');
		}
		$view->render([
			'kims' => json_encode(array_diff($kim->getKims(),['demo']))
		]);
	}

	public function index() {
		//	
	}
	
}