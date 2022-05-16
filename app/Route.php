<?php

class Route {
	
	private static $routes = [];
	
	public static function add($route,$controller,$method) {
		self::$routes[$route] = [
			'controller' => $controller,
			'method' => $method
		];
	}
	public static function match() {
		$url = $_SERVER['REQUEST_URI'];
		if(array_key_exists($url,self::$routes)) {
			return self::$routes[$url];
		}
		return false;
	}
	public static function run() {
		$match = self::match();
		$controller = $match['controller'];
		$method = $match['method'];
		if($match) {
			include '../app/controllers/'.$controller.'Controller.php';
			switch($controller) {
				case 'Auth': {
					$controller = new AuthController($controller);
					break;
				}
				case 'Test': {
					$controller = new TestController($controller);
					break;
				}
			}
			$controller->$method();
		}
		else {
			echo 404;
		}
	}
}

Route::add('/login','Auth','loginView');
Route::add('/test','Test','test');
Route::add('/admin/register','Auth','registerView');
Route::add('/admin/register/submit','Auth','register');
Route::add('/login/submit','Auth','login');
