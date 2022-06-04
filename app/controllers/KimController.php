<?php
include '../app/Controller.php';
include '../app/models/Kim.php';

class KimController extends Controller {
	
	public function __construct() {
		return parent::__construct('admin');
	}

	public function addkim($post) {
		$params = [
			'alert' => ''
		];
		if($this->access()) {
			$view = new View('addkim');
			if(!empty($post)) {
				$kim = new Kim;
				$msg = $kim->add($post,$_FILES);
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

	function deleteKims($post) {
		if($this->deny()) {
			View::show('page404');
			return;
		}
		$kim = new Kim;
		$ok = $kim->delete($post);
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