<?php

Model::include('Result');

class ResultApiController extends Controller {
	

	public function results() {
		$result = new Result;
		$response = $result->query()
		->select()
		->send();
		return responseJSON(['data' => $response['data']]);
	}
	
	public function result($index) {
		$result = new Result;
		$response = $result->query()
		->select()
		->send();
		if(!in_array($index-1,array_keys($response['data']))) {
			return responseCode(404);
		}
		return responseJSON(['data' => $response['data'][$index-1]]);
	}

	public function delete($request) {
		$result = new Result;
		$result->delete($request->json(false));
		return responseCode(200);
	}

}