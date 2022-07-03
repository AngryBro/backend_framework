<?php

Model::include('Test');

class TestApiController extends Controller {

	function kimName() {
		$test = new Test;
		echo json_encode($test->kimName($_SESSION['email']));
	}

	function kimTasks() {
		$test = new Test;
		$tasks = $test->kimTasks($_SESSION['email']);
		if($tasks!==null) {
			echo json_encode([
				'tasks' => array_keys(json_decode($tasks['answers'],true)),
				'files' => json_decode($tasks['files'],true)
			]);
		}
		else {
			abort(404);
		}
	}

	function taskImg($task) {
		$test = new Test;
		$path = $test->taskImg($_SESSION['email'],$task);
		if($path!=null) {
			require $path;
		}
		else {
			abort(404);
		}
	}

}