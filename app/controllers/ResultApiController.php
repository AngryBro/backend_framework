<?php

Model::include('Result');

class ResultApiController extends Controller {
	

	public function results() {
		$result = new Result;
		$response = $result->query()
		->select()
		->send();
		echo json_encode($response['data']);
	}
	
	public function result($index) {
		$result = new Result;
		$response = $result->query()
		->select()
		->send();
		if(!in_array($index-1,array_keys($response['data']))) {
			abort(404);
		}
		echo json_encode($response['data'][$index-1]);
	}

	public function delete($request) {
		$result = new Result;
		$result->delete(json_decode($request['json'],false));
		echo json_encode(true);	
	}

}