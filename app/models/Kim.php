<?php

include '../app/Model.php';

class Kim extends Model {
	
	public function __construct() {
		return parent::__construct('Kims');
	}

	public function add($post,$files) {
		$uploaded = $files['zip']['error']==UPLOAD_ERR_OK;
		$msg = ($uploaded)&&(!empty($post))?'Успешно':'Ошибка';
		$name = $files['zip']['tmp_name'];
		$tmp_path = '../tempfiles';
		$zip_path = $tmp_path.'/kim'.$post['kim'].'.zip';
		move_uploaded_file($name,$zip_path);
		$zip = new ZipArchive;
		$zip->open($zip_path);
		$zip->extractTo($tmp_path);
		$zip->close();
		unlink($zip_path);
		$kim_ans = file_get_contents($tmp_path.'/ans.json');
		$kim_ans = json_decode($kim_ans,true);
		$task_count = 0;
		for($i=1; array_key_exists($i,$kim_ans); $i++) {
			$task_count++;
		}
		for($i=1;$i<=$task_count;$i++) {
			$kim_files[$i] = md5('kim'.$post['kim'].'number'.$i).'.png';
		}
		$kim_files['i'] = md5('kim'.$post['kim'].'info').'.png'; 
		$kim_info = [
			'task_count' => $task_count,
			'ans' => $kim_ans,
			'files' => $kim_files
		];
		$this->db_set($post['kim'],$kim_info);
		for($i=1;$i<=$task_count;$i++) {
			copy($tmp_path.'/'.$i.'.png','img/'.$kim_files[$i]);
			unlink($tmp_path.'/'.$i.'.png');
		}
		copy($tmp_path.'/info.png','img/'.$kim_files['i']);
		unlink($tmp_path.'/info.png');
		unlink($tmp_path.'/ans.json');
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

