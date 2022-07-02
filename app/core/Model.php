<?php

abstract class Model {
	protected $table;
	protected $schema;

	function query() {
		return new Query($this->table,$this->schema);
	}

	static function include($model) {
		include config('file')['models'].$model.'.php';
	}
}