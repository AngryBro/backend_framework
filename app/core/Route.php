<?php

class Route {
	
	private static $static_get_routes = [];
	private static $static_post_routes = [];
	private static $dynamic_routes = [];
	private static $default = ['set' => false];
	private static $view_routes = [];
	
	static function default($url) {
		self::$default = [
			'set' => true,
			'url' => $url
		];
	}

	static function view($route,$view) {
		self::$view_routes[$route] = $view;
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
		return;
	}

	public static function post($route,$controller,$method) {
		$temp = [
			'controller' => $controller,
			'method' => $method
		];
		self::$static_post_routes[$route] = $temp;
		return;
	}
	
	public static function match() {
		$url = $_SERVER['REQUEST_URI'];

		if(array_key_exists($url,self::$view_routes)) {
			return [
				'matched' => true,
				'view' => self::$view_routes[$url]
			];
		}

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
				if(($part != $split[$number])&&($part[0].$part[-1]!='{}')) {
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
		$request_uri = $_SERVER['REQUEST_URI'];
		if(($request_uri=='/')&&self::$default['set']) {
			redirect(self::$default['url']);
			return;
		}
		$splited = explode('/',$request_uri);
		$api = $splited[0]=='api';
		$match = self::match();
		if($match['matched']) {
			if(isset($match['view'])) {
				return view($match['view']);
			}
			$controller = $match['route']['controller'];
			$controller = explode('Controller',$controller);
			$controller = $controller[0];
			$roles = config('access');
			$role = isset($_SESSION['role'])?$_SESSION['role']:$roles['default'];
			if((array_key_exists($controller.'Controller',$roles))&&
				(!in_array($role,$roles[$controller.'Controller']))) {
					if($api) {
						return responseJSON(['ok' => false],403);
					}
					abort(403);
			}
			$method = $match['route']['method'];
			include config('file')['controllers'].$controller.'Controller.php';
			eval('$controller = new '.$controller.'Controller;');
			if(isset($match['params'])) {
				$keys_params = array_keys($match['params']);
				foreach($match['params'] as $key => $param) {
					$match['params'][$key] = filter_var($param,FILTER_UNSAFE_RAW);
				}
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
				$controller->$method(new Request($_POST));
			}
		}
		else {
			if($api) {
				return responseJSON(['ok' => false],404);
			}
			abort(404);
		}
		return;
	}
}
