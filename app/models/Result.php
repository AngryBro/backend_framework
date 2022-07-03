<?php

class Result extends Model {

    function __construct() {
        $this->table = 'results';
    }

    function delete($ids) {
        $this->query()
        ->delete()
        ->whereIn(['id' => $ids])
        ->send();
        return true;
    }

    public function check($email,$kim,$answers,$actualAnswers) {
		$final = [];
		foreach($answers as $task => $ans) {
			$final[$task] = [
				'right' => $ans,
				'actual' => $actualAnswers[$task],
				'correct' => $ans==$actualAnswers[$task]
			];
		}
		$response = $this->query()
		->insert([
            'email' => $email,
            'kim' => $kim,
            'result' => json_encode($final),
            'id' => 'DEFAULT'
		])
		->send();
        return $response['ok'];
	}

}