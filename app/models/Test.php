<?php

Model::include('User');
Model::include('Kim');

class Test extends Model {

	function kimName($email) {
		$user = new User;
		$response = $user->query()
		->select(['kim'])
		->where(['email' => $email])
		->send();
		if(!$response['empty']) {
			return $response['data'][0]['kim'];
		}
		return null;
	}

	function kimTasks($email) {
		$kim = new Kim;
		$kimName = $this->kimName($email);
		$response = $kim->query()
		->select(['answers','files'])
		->where(['name' => $kimName])
		->send();
		if(!$response['empty']) {
			return $response['data'][0];
		}
		return null;
	}

	function kimTaskNumbers($email) {
		$answers = $this->kimTasks($email);
		if($answers!==null) {
			return array_keys(json_decode($answers['answers'],true));
		}
	}

	function taskImg($email,$task) {
		$tasks = $this->kimTaskNumbers($email);
		if(!in_array($task,$tasks)&&($task!='info')) {
			return null;
		}
		$kim = $this->kimName($email);
		return config('file')['storage'].$kim.'/'.$task.'.png';
	}

	function download($file,$email) {
		$kim_name = $this->kimName($email);
		$file = implode('.',$file);
		$path = config('file')['storage'].$kim_name.'/'.$file;
		if(file_exists($path)) {
			header('Content-Disposition: attachment; filename="'.$file.'"');
			readfile($path);
		}
		else {
			abort(404);
		}
	}
	
}

