<?php

Model::include('User');

class AdminApiController extends Controller {
	

	public function index() {
		//	
	}

	function getUsers() {
		$user = new User;
		$response = $user->query()
		->select(['email'])
		->send();
		echo json_encode($response['data']);
	}
	
}