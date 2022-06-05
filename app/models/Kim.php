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
			array_push($errors,'Файл не загружен');
		}
		if(empty($post)) {
			array_push($errors,'Отсутствует идентификатор КИМа');
			$kim_number = '';

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
		else {
			array_push($errors,'Архив не перемещён');
		}
		$kim_data = scandir($tmp_path);
		$kim_data = array_diff($kim_data,['.','..']);
		if(!file_exists($tmp_path.'/answers.json')) {
			array_push($errors,'Нет файла answers.json');
			$kim_ans = [];
		}
		else {
			$kim_ans = file_get_contents($tmp_path.'/answers.json');
			$kim_ans = json_decode($kim_ans,true);
			foreach($kim_ans as $task => $ans) {
				$kim_ans[$task] = $this->parser($ans);
			}
		}
		$task_numbers = array_keys($kim_ans);
		foreach($task_numbers as $i) {
			if(!in_array($i.'.png',$kim_data)) {
				array_push($errors,'Нет файла '.$i.'.png');
			}
		}
		if(!in_array('info.png',$kim_data)) {
			array_push($errors,'Нет файла info.png');
		}
		$kim_files = [];
		foreach($task_numbers as $i) {
			$kim_files[$i] = md5('kim'.$kim_number.'number'.$i).'.png';
		}
		$kim_files['i'] = md5('kim'.$kim_number.'info').'.png';
		$kim_info = [
			'answers' => $kim_ans,
			'files' => $kim_files
		];
		if(count($errors)) {
			$response = [
				'ok' => false,
				'errors' => $errors
			];
		}
		else {
			foreach($task_numbers as $i) {
				copy($tmp_path.'/'.$i.'.png','img/'.$kim_files[$i]);
			}
			copy($tmp_path.'/info.png','img/'.$kim_files['i']);
			$this->kimsDB->set($kim_number,$kim_info);
			$response = [
				'ok' => true
			];
		}
		if(count($kim_data)) {
			foreach($kim_data as $file) {
				unlink($tmp_path.'/'.$file);
			}
		}
		return $response;
	}

	private function parser($str) {
		$str_arr = explode(' ',$str);
		$str = implode('',$str_arr);
		return $str;
	}

	public function delete($post) {
		if(empty($post)) {
			return false;
		}
		$kims = json_decode($post['json'],false);
		foreach($kims as $kim) {
			$files = $this->kimsDB->get($kim)['files'];
			foreach($files as $file) {
				unlink('img/'.$file);
			}
			$this->kimsDB->unset($kim);
		}
		return true;
	}

	public function getKims() {
		return array_diff($this->kimsDB->keys());
	}

	public function sample() {
		//
	}
	
}

