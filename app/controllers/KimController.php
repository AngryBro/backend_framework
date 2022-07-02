<?php
include '../app/models/Kim.php';

class KimController extends Controller {
	

	public function addkim() {
		return view('addkim');
	}

	function add($request) {
		$kim = new Kim;
		$response = $kim->add($request,$_FILES);
		echo json_encode($response);
	}

	function deleteKims($post) {
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
		return view('delkim');
	}
	
	function getkims() {
		$kim = new Kim;
		echo json_encode($kim->getKims());
	}

	function make($names) {
		$kim = new Kim;
		$kim->make($names[0],$names[1],'hybrid');
	}

}