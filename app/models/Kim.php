<?php

include '../app/Model.php';

class Kim extends Model {
	
	public function __construct() {
		return parent::__construct('Kims');
	}

	public function add($post,$files) {
		$uploaded = $files['zip']['error']==UPLOAD_ERR_OK;
		$errors = [];
		if(empty($post)) {
			array_push($errors,'Отсутствует номер КИМа');
			$kim_number = -1;

		}
		else {
			$kim_number = $post['kim'];
		}
		$name = $files['zip']['tmp_name'];
		$tmp_path = '../tempfiles';
		$zip_path = $tmp_path.'/kim'.$kim_number.'.zip';
		move_uploaded_file($name,$zip_path);
		$zip = new ZipArchive;
		$zip->open($zip_path);
		$zip->extractTo($tmp_path);
		$zip->close();
		unlink($zip_path);
		if(!file_exists($tmp_path.'/ans.json')) {
			array_push($errors,'No file "ans.json"');
			$kim_ans = [];
		}
		else {
			$kim_ans = file_get_contents($tmp_path.'/ans.json');
			$kim_ans = json_decode($kim_ans,true);
		}
		$task_count = 0;
		for($i=1; array_key_exists($i,$kim_ans); $i++) {
			$task_count++;
		}
		for($i=1;$i<=$task_count;$i++) {
			$kim_files[$i] = md5('kim'.$kim_number.'number'.$i).'.png';
		}
		if(file_exists($tmp_path.'/info.png')) {
			$kim_files['i'] = md5('kim'.$kim_number.'info').'.png';
		}
		else {
			array_push($errors,'No file "info.png"');
		}
		$kim_info = [
			'task_count' => $task_count,
			'ans' => $kim_ans,
			'files' => $kim_files
		];
		for($i=1;$i<=$task_count;$i++) {
			if(!copy($tmp_path.'/'.$i.'.png','img/'.$kim_files[$i])) {
				array_push($errors,'No file "'.$i.'.png"');
			}
			unlink($tmp_path.'/'.$i.'.png');
		}
		copy($tmp_path.'/info.png','img/'.$kim_files['i']);
		unlink($tmp_path.'/info.png');
		unlink($tmp_path.'/ans.json');
		if(empty($errors)) {
			$this->db_set($kim_number,$kim_info);
			$msg = 'Успешно';
		}
		else {
			$msg = 'Ошибки:\n'.implode('\n',$errors);
		}
		return $msg;
	}

	public function delete($post) {
		$kim = $this->db_get($post['kim']);
		$this->db_unset($post['kim']);
		for($i=1;$i<=$kim['task_count'];$i++) {
			unlink('img/'.$kim['files'][$i]);
		}
		unlink('img/'.$kim['files']['i']);
	}

	public function sample() {
		//
	}
	
}

