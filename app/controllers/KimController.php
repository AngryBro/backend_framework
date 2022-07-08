<?php

Model::include('Kim');

class KimController extends Controller {
	

	public function addkim() {
		return view('addkim');
	}

	function add($request) {
		$request = $request->validate([
			'kim' => ['required']
		]);
		$kim = new Kim;
		$response = $kim->add($request,$_FILES);
		return responseJSON($response);
	}

	function deleteKims($request) {
		$kim = new Kim;
		$kims_to_delete = $request->json(false);
		$kim->delete($kims_to_delete);
		return responseCode(200);
	}

	function delkims() {
		return view('delkim');
	}

}