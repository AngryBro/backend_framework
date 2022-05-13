<?php

class Route {
	protected static $routes = [];
	protected static $params = [];
	public static function add($route,$controller,$action) {
		self::$routes[$route] = [
			'controller' => $controller,
			'action' => $action 
		];
	}
	public static function match() {
		$url = $_SERVER['REQUEST_URI'];
		if(array_key_exists($url,self::$routes)) {
			self::$params['controller'] = self::$routes[$url]['controller'];
			return true;
		}
		return false;
	}
	public static function run() {
		if(self::match()) {
			$path = '../app/Controllers/'.self::$params['controller'];
			echo $path;
		}
		else {
			echo 404;
		}
	}
}

Route::add('/test','TestController.php','none');