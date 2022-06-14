<?php

class Test extends Model {

	private $testDB;
	private $kimsDB;
	private $usersDB;

	public function __construct() {
		$this->testDB = new DB('Test');
		$this->kimsDB = new DB('Kims');
		$this->usersDB = new DB('Users');
	}

	function getKimName($user) {
		return json_encode($this->usersDB->get($user)['kim']);
	}

	function download($file,$user) {
		$kim_name = json_decode($this->getKimName($user),false);
		$path = '../storage/'.$kim_name.'/'.$file;
		header('Content-Disposition: attachment; filename="'.$file.'"');
		readfile($path);
	}

	public function load($user) {
		$name = $this->usersDB->get($user)['kim'];
		$kim = $this->kimsDB->get($name);
		$params = [
			'files' => $kim['files'],
			'name' => $name,
			'additional_files' => $kim['additional_files']
		];
		return $params;
	}

	public function check($answers,$user) {
		$kim_name = $this->usersDB->get($user)['kim'];
		$right_ans = $this->kimsDB->get($kim_name)['answers'];
		$final = [];
		foreach($right_ans as $task => $ans) {
			$final[$task] = [
				'right' => $ans,
				'actual' => $answers[$task],
				'correct' => $ans==$answers[$task]
			];
		}
		$this->testDB->push_data([
			'user' => $user,
			'kim' => $kim_name,
			'answers' => $final
		]);
	}
	
}

