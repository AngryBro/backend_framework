<?php

include '../app/Model.php';

class Test extends Model {

	public function __construct() {
		return parent::construct('Kims');
	}

	public function addKim($post,$files) {
		$uploaded = $files['zip']['error']==UPLOAD_ERR_OK;
		$msg = ($uploaded)&&(!empty($post))?'Успешно':'Ошибка';
		$name = $files['zip']['tmp_name'];
		$zip_path = '../tempfiles/upload'.$post['kim'].'/kim'.$post['kim'].'.zip';
		move_uploaded_file($name,$zip_path);
		$zip = new ZipArchive;
		$zip->open($zip_path);
		$zip->extractTo()
	}

	public function send() {
		//
	}
	
}

