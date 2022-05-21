<?php

class Route {
	
	private static $routes = [];
	
	public static function add() {
		$args = func_get_args();
		$route = $args[0];
		$controller = $args[1];
		$method = isset($args[2])?$args[2]:'view';
		self::$routes[$route] = [
			'controller' => $controller,
			'method' => $method,
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
				case 'Admin': {
					$controller = new AdminController($controller);
					break;
				}
			}
			$controller->$method();
		}
		else {
			include '../app/View.php';
			$view = new View('page404');
			$view->render();
		}
	}
}
