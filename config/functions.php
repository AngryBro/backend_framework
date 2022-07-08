<?php

function load_app() {
	$load_files = config('file');
	foreach($load_files['core_files'] as $file) {
		include $file;
	}
	include $load_files['routes'];
}

function responseJSON($json = [],$status=200) {
	$description = config('responses')[$status];
	$description = isset($description)?$description:'Unknown status';
	header("HTTP/1.0 ".$status." ".$description);
	echo json_encode($json);
}

function responseCode($code) {
	$description = config('responses')[$code];
	$description = isset($description)?$description:'Unknown status';
	header("HTTP/1.0 ".$code." ".$description);
}

function view($html) {
    $htmls = config('file')['assets']['html'];
	require $htmls.$html.'.html';
}

function abort($code) {
	http_response_code($code);
	if(file_exists(config('file')['assets']['html'].'page'.$code.'.html')) {
		view('page'.$code);
	}
	exit;
}

function redirect($url) {
	header('Location: '.$url);
}

function config($cfg) {
	return include '../config/'.$cfg.'.php';
}

function env($param) {
	$env = file_get_contents('../.env');
	$env = explode("\n",$env);
	foreach($env as $key => $str) {
		$env[$key] = explode("=",$str);
		foreach($env[$key] as $subkey => $substr) {
			$env[$key][$subkey] = trim($substr);
		}
	}
	foreach($env as $array) {
		if($array[0]==$param) {
			return $array[1];
		}
	}
	return null;
}