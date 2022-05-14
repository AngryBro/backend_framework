<?php
abstract class Controller {
	
	public $params;
	
	public function __construct($params) {
		$this->params = $params;
	}
}