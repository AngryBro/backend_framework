<?php

Model::include('Kim');

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
		$ok = $kim->delete(json_decode($post['json'],false));
		echo json_encode($ok);
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