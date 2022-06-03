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

	function deleteKims() {
		if($this->deny()) {
			View::show('page404');
			return;
		}
		$kim = new Kim;
		$ok = $kim->delete($_POST);
		if($ok) {
			echo json_encode($kim->getKims());
		}
		else {
			echo json_encode(['error']);
		}
	}

	function delkims() {
		if($this->deny()) {
			View::show('page404');
			return;
		}
		View::show('delkim');
	}
	
	function getkims() {
		$this->accessable();
		$kim = new Kim;
		echo json_encode($kim->getKims());
	}

}