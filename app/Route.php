<?php

class Route {
	
	private static $static_routes = [];
	private static $dynamic_routes = [];
	
	public static function get() {
		$args = func_get_args();
		$route = $args[0];
		$controller = $args[1];
		$method = isset($args[2])?$args[2]:'index';
		$temp = [
			'controller' => $controller,
			'method' => $method,
		];
		if(strrpos($route,'{param}')===false) {
			self::$static_routes[$route] = $temp;
		}
		else {
			self::$dynamic_routes[$route] = $temp;
		}
	}

	public static function post($route,$controller,$method) {
		self::$static_routes[$route] = [
			'controller' => $controller,
			'method' => $method
		];
	}
	
	public static function match() {
		$url = $_SERVER['REQUEST_URI'];
		if(array_key_exists($url,self::$static_routes)) {
			return [
				'matched' => true,
				'route' => self::$static_routes[$url]
			];
		}
		
		$split = explode('/',$url);

		foreach(self::$dynamic_routes as $route => $action) {
			$route_split = explode('/',$route);
			$matched = true;
			$params = [];
			if(count($route_split)!=count($split)) {
				continue;
			}
			foreach($route_split as $number => $part) {
				if($part=='{param}') {
					array_push($params,$split[$number]);
				}
				if(($part != $split[$number])&&($part!='{param}')) {
					$matched = false;
					$params = [];
					break;
				}
			}
			if($matched) {
				return [
					'matched' => true,
					'route' => self::$dynamic_routes[$route],
					'params' => $params
				];
			}
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
			if(isset($match['params'])) {
				$controller->$method($match['params']);
			}
			else {
				$controller->$method();
			}
		}
		else {
			include '../app/View.php';
			View::show('page404');
		}
	}
}
