<?php

include '../app/Model.php';

class Kim extends Model {
	
	private $kimsDB;

	public function __construct() {
		$this->kimsDB = new DB('Kims');
	}

	public function add($post,$files) {
		$uploaded = $files['zip']['error']==UPLOAD_ERR_OK;
		$errors = [];
		if(!$uploaded) {
			array_push($errors,'File not uploaded');
		}
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
		$moved = move_uploaded_file($name,$zip_path);
		if($moved) {
			$zip = new ZipArchive;
			$opened = $zip->open($zip_path);
			if($opened===true) {
				$zip->extractTo($tmp_path);
				$zip->close();
			}
			unlink($zip_path);
		}
		$kim_data = scandir($tmp_path);
		$kim_data = array_diff($kim_data,['.','..']);
		if(!file_exists($tmp_path.'/ans.json')) {
			array_push($errors,'No file ans.json');
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
		for($i=1; $i<=$task_count; $i++) {
			if(!in_array($i.'.png',$kim_data)) {
				array_push($errors,'No file '.$i.'.png');
			}
		}
		if(!in_array('info.png',$kim_data)) {
			array_push($errors,'No file info.png');
		}
		$kim_files = [];
		for($i=1;$i<=$task_count;$i++) {
			$kim_files[$i] = md5('kim'.$kim_number.'number'.$i).'.png';
		}
		$kim_files['i'] = md5('kim'.$kim_number.'info').'.png';
		$kim_info = [
			'task_count' => $task_count,
			'ans' => $kim_ans,
			'files' => $kim_files
		];
		if(count($errors)) {
			$join = implode('\n',$errors);
			$msg = 'Ошибки:\n'.$join;
		}
		else {
			for($i=1;$i<=$task_count;$i++) {
				copy($tmp_path.'/'.$i.'.png','img/'.$kim_files[$i]);
			}
			copy($tmp_path.'/info.png','img/'.$kim_files['i']);
			$this->kimsDB->set($kim_number,$kim_info);
			$msg = 'Успешно';
		}
		if(count($kim_data)) {
			foreach($kim_data as $file) {
				unlink($tmp_path.'/'.$file);
			}
		}
		return $msg;
	}

	public function delete($post) {
		if(empty($post)) {
			return;
		}
		$kims = json_decode($post['json'],false);
		foreach($kims as $kim) {
			$files = $this->kimsDB->get($kim)['files'];
			foreach($files as $file) {
				unlink('img/'.$file);
			}
			$this->kimsDB->unset($kim);
		}
	}

	public function getKims() {
		return $this->kimsDB->keys();
	}

	public function sample() {
		//
	}
	
}

