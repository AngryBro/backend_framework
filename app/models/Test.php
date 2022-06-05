<?php

include '../app/Model.php';

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

	public function load($user) {
		$name = $this->usersDB->get($user)['kim'];
		$kim = $this->kimsDB->get($name);
		$params = [
			'task_count' => $kim['task_count'],
			'files' => $kim['files'],
			'name' => $name
		];
		$params = json_encode($params);
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

