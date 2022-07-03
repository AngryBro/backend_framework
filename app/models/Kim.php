<?php

class Kim extends Model {
	
	public function __construct() {
		$this->table = 'kims';
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
		$tmp_path = config('file')['temp_files'];
		$zip_path = $tmp_path.'kim'.$kim_number.'.zip';
		$moved = move_uploaded_file($name,$zip_path);
		if($moved) {
			$zip = new ZipArchive;
			$opened = $zip->open($zip_path);
			if($opened===true) {
				$zip->extractTo($tmp_path);
				$zip->close();
			}
			else {
				array_push($errors,'Архив не открыт');
			}
			unlink($zip_path);
		}
		else {
			array_push($errors,'Архив не перемещён');
		}
		$kim_data = scandir($tmp_path);
		$kim_data = array_diff($kim_data,['.','..']);
		if(!file_exists($tmp_path.'answers.json')) {
			array_push($errors,'Нет файла answers.json');
			$kim_ans = [];
		}
		else {
			$kim_ans_json = file_get_contents($tmp_path.'answers.json');
			$kim_ans = json_decode($kim_ans_json,true);
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
		$kim_additional_files = [];
		if(!in_array('files.json',$kim_data)) {
			array_push($errors,'Нет файла files.json');
		}
		else {
			$kim_additional_files_json = file_get_contents($tmp_path.'files.json');
			$kim_additional_files = json_decode($kim_additional_files_json,true);
			foreach($kim_additional_files as $task) {
				foreach($task as $file) {
					if(!in_array($file,$kim_data)) {
						array_push($errors,'Нет файла '.$file);
					}
				}
			}
			$response = $this->query()
			->select(['name'])
			->where(['name' => $kim_number])
			->send();
			if(!$response['empty']) {
				$this->delete([$kim_number]);
			}
			$response = $this->query()
			->insert([
				'files' => $kim_additional_files_json,
				'answers' => $kim_ans_json,
				'name' => $kim_number
			])
			->send();

			if(!$response['ok']) {
				array_push($errors,'Ошибка записи КИМа');
			}
		}

		if(count($errors)) {
			$response = [
				'ok' => false,
				'errors' => $errors
			];
		}
		else {
			$kim_storage_path = config('file')['storage'].$kim_number;
			mkdir($kim_storage_path);
			foreach($task_numbers as $i) {
				copy($tmp_path.$i.'.png',$kim_storage_path.'/'.$i.'.png');
			}
			copy($tmp_path.'info.png',$kim_storage_path.'/info.png');
			foreach($kim_additional_files as $task) {
				foreach($task as $file) {
					copy($tmp_path.$file,$kim_storage_path.'/'.$file);
				}
			}
			$response = [
				'ok' => true
			];
		}
		if(count($kim_data)) {
			foreach($kim_data as $file) {
				unlink($tmp_path.$file);
			}
		}
		return $response;
	}

	private function parser($str) {
		$str = str_replace(' ','',$str);
		return $str;
	}

	public function delete($kims) {
		$response = $this->query()
		->select()
		->whereIn(['name' => $kims])
		->send();
		$kims_data = $response['data'];
		$storage = config('file')['storage'];
		foreach($kims_data as $kim_data) {
			$files = json_decode($kim_data['files'],true);
			foreach($files as $task) {
				foreach($task as $file) {
					unlink($storage.$kim_data['name'].'/'.$file);
				}
			}
			$files = ['info.png'];
			$ans = json_decode($kim_data['answers'],true);
			$ans = array_keys($ans);
			foreach($ans as $task) {
				array_push($files,$task.'.png');
			}
			foreach($files as $file) {
				unlink($storage.$kim_data['name'].'/'.$file);
			}
			rmdir($storage.$kim_data['name']);
		}
		$response = $this->query()
		->delete()
		->whereIn(['name' => $kims])
		->send();
		return $response['ok'];
	}
	
}

