<?php

abstract class Model {

	protected $table;

	function query() {
		return new Query($this->table);
	}

	static function include($model) {
		include config('file')['models'].$model.'.php';
	}
}