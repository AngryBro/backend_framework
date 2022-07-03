<?php

Model::include('Kim');

class KimApiController extends Controller {
	

	public function index() {
		$kim = new Kim;
		$response = $kim->query()
		->select(['name'])
		->send();
		echo json_encode($response['data']);	
	}
	
}