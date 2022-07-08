<?php

Model::include('User');

class AdminApiController extends Controller {
	

	public function index() {
		$user = new User;
		$response = $user->query()
		->select(['email'])
		->send();
		return responseJSON([
			'data' => $response['data'],
			'ok' => true
		]);	
	}
	
}