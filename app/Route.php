<?php

include '../app/Model.php';
include '../app/View.php';
include '../app/Controller.php';

class Route {
	
	private static $static_get_routes = [];
	private static $static_post_routes = [];
	private static $dynamic_routes = [];
	private static $default = ['set' => false];
	
	static function default($url) {
		self::$default = [
			'set' => true,
			'url' => $url
		];
	}

	public static function get() {
		$args = func_get_args();
		$route = $args[0];
		$controller = $args[1];
		$method = isset($args[2])?$args[2]:'index';
		$temp = [
			'controller' => $controller,
			'method' => $method,
		];
		if((strrpos($route,'{')===false)||(strrpos($route,'}')===false)) {
			self::$static_get_routes[$route] = $temp;
		}
		else {
			self::$dynamic_routes[$route] = $temp;
		}
	}

	public static function post($route,$controller,$method) {
		self::$static_post_routes[$route] = [
			'controller' => $controller,
			'method' => $method
		];
	}
	
	public static function match() {
		$url = $_SERVER['REQUEST_URI'];

		if(array_key_exists($url,self::$static_get_routes)||array_key_exists($url,self::$static_post_routes)) {
			if(empty($_POST)) {
				return [
					'matched' => true,
					'route' => self::$static_get_routes[$url]
				]; 
			}
			return [
				'matched' => true,
				'route' => self::$static_post_routes[$url]
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
				if((strlen($part)>0)&&($part[0].$part[-1]=='{}')) {
					$params[substr($part,1,-1)] = $split[$number];
				}
				if(($part != $split[$number])&&(($part[0]!='{')||($part[-1]!='}'))) {
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
		session_start();
		if(($_SERVER['REQUEST_URI']=='/')&&self::$default['set']) {
			header('Location: '.self::$default['url']);
			return;
		}
		$match = self::match();
		if($match['matched']) {
			$controller = $match['route']['controller'];
			$method = $match['route']['method'];
			include '../app/controllers/'.$controller.'Controller.php';
			eval('$controller = new '.$controller.'Controller;');
			if(!$controller->access) {
				abort(403);
				return;
			}
			if(isset($match['params'])) {
				$keys_params = array_keys($match['params']);
				if(count($keys_params)==1) {
					$controller->$method($match['params'][$keys_params[0]]);
				}
				else {
					$controller->$method($match['params']);
				}
			}
			elseif(empty($_POST)) {
				$controller->$method();
			}
			else {
				$controller->$method($_POST);
			}
		}
		else {
			abort(404);
		}
	}
}
