<?php

class Route {
	
	private static $routes = [];
	
	public static function get() {
		$args = func_get_args();
		$route = $args[0];
		$controller = $args[1];
		$method = isset($args[2])?$args[2]:'index';
		self::$routes[$route] = [
			'controller' => $controller,
			'method' => $method,
		];
	}

	public static function add() {
		$args = func_get_args();
		$route = $args[0];
		$controller = $args[1];
		$method = isset($args[2])?$args[2]:'index';
		self::$routes[$route] = [
			'controller' => $controller,
			'method' => $method
		];
	}

	public static function view($route,$view) {
		//
	}
	
	public static function match() {
		$url = $_SERVER['REQUEST_URI'];
		if(array_key_exists($url,self::$routes)) {
			return [
				'matched' => true,
				'route' => self::$routes[$url]
			];
		}
		$split = explode('/',$url);
		$param = array_pop($split);
		array_push($split,'{param}');
		$url = implode('/',$split);
		if(array_key_exists($url,self::$routes)) {
			return [
				'matched' => true,
				'route' => self::$routes[$url],
				'param' => $param
			];
		}
		return [
			'matched' => false
		];
	}
	
	public static function run() {
		$match = self::match();
		if($match['matched']) {
			$controller = $match['route']['controller'];
			$method = $match['route']['method'];
			include '../app/controllers/'.$controller.'Controller.php';
			eval('$controller = new '.$controller.'Controller;');
			if(isset($match['param'])) {
				$controller->$method($match['param']);
			}
			else {
				$controller->$method();
			}
		}
		else {
			include '../app/View.php';
			$view = new View('page404');
			$view->render();
		}
	}
}
