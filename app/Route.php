<?php
require_once '../controllers/TestController.php';

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
			self::$params['action'] = self::$routes[$url]['action'];
			return true;
		}
		return false;
	}
	public static function run() {
		if(self::match()) {
			$path = '../controllers/'.self::$params['controller'];
			$controller = new TestController(self::$params);
			$action = self::$params['action'];
			$controller->$action();
		}
		else {
			echo 404;
		}
	}
}

Route::add('/test','TestController.php','ShowTest');