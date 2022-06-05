<?php
include '../app/Controller.php';
include '../app/models/Kim.php';

class KimController extends Controller {
	
	public function __construct() {
		return parent::__construct('admin');
	}

	public function addkim() {
		$this->accessable();
		View::show('addkim');
	}

	function add($request) {
		$this->accessable();
		$kim = new Kim;
		$response = $kim->add($request,$_FILES);
		echo json_encode($response);
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
		$this->accessable();
		View::show('delkim');
	}
	
	function getkims() {
		$this->accessable();
		$kim = new Kim;
		echo json_encode($kim->getKims());
	}

}