<?php

define('_SYS_PATH', dirname(__FILE__));
define('_ROOT_PATH', dirname(_SYS_PATH));
define('_MODEL_PATH', _ROOT_PATH.'/model');
define('_VIEW_PATH', _ROOT_PATH.'/view');
define('_CONTROLLER_PATH', _ROOT_PATH.'/controller');
define('_CONFIG_PATH', _ROOT_PATH.'/config');
define('_LIB_PATH', _ROOT_PATH.'/lib');
define('_LOG_PATH', _ROOT_PATH.'/log');
define('_SYS_CORE_PATH', _SYS_PATH.'/core');
define('_SYS_LIB_PATH', _SYS_PATH.'/lib');
define('_USE_CONFIG_FILE', _CONFIG_PATH.'/default.php');

final class Application {

	public static $_config = NULL;
	public static $_lib = NULL;

	public static function init() {
		self::$_config = require_once _USE_CONFIG_FILE;
		self::$_lib = array(
			'cache' => _SYS_LIB_PATH.'/lib_cache.php',
			'mysql'=> _SYS_LIB_PATH.'/lib_mysql.php',
			'route' => _SYS_LIB_PATH.'/lib_route.php',
			'template' => _SYS_LIB_PATH.'/lib_template.php'
		);
		require_once _SYS_CORE_PATH.'/model.php';
		require_once _SYS_CORE_PATH.'/controller.php';
	}

	public static function load() {
		foreach (self::$_lib as $key => $value) {
			require_once self::$_lib[$key];
			$u_key = ucfirst($key);
			self::$_lib[$key] = new $u_key;
		}
		if (is_object(self::$_lib['cache'])) {
			self::$_lib['cache'] -> init(
				_ROOT_PATH.'/'.self::$_config['cache_dir'],
				self::$_config['cache_prefix'],
				self::$_config['cache_time'],
				self::$_config['cache_mode']
			);
		}
	}

	public static function routeToController($url_array) {
		$app = NULL;
		$controller = NULL;
		$model = NULL;
		$action = NULL;
		$params = NULL;
		if (isset($url_array['app']))
			$app = $url_array['app'];
		if (isset($url_array['ctl']))
			$controller = $model = $url_array['ctl'];
		else
			$controller = $model = self::$_config['route_default_controller'];
		if ($app) {
			$controller_file = _CONTROLLER_PATH.'/'.$app.'/'.$controller.'Controller.php';
			$model_file = _MODEL_PATH.'/'.$app.'/'.$model.'Model.php';
		} else {
			$controller_file = _CONTROLLER_PATH.'/'.$controller.'Controller.php';
			$model_file = _MODEL_PATH.'/'.$model.'Model.php';
		}
		if (isset($url_array['act']))
			$action = $url_array['act'];
		else
			$action = self::$_config['route_default_action'];
		if (isset($url_array['params']))
			$params = $url_array['params'];
		if (file_exists($controller_file)) {
			require_once $controller_file;
			if (file_exists($model_file))
				require_once $model_file;
			$controller .= 'Controller';
			$controller = new $controller;
			if (method_exists($controller, $action))
				$params ? $controller -> $action($params) : $controller -> $action();
		}
	}

	public static function run() {
		self::init();
		self::load();
		self::$_lib['route'] -> setUrlType(self::$_config['route_url_type']);
		$url_array = self::$_lib['route'] -> getUrlArray();
		self::routeToController($url_array);
	}

	public static function loadCustomLib($load_class) {
		$lib_file = _LIB_PATH.'/'.self::$_config['lib_prefix'].'_'.$load_class.'.php';
		if (file_exists($lib_file)) {
			require_once $lib_file;
			$load_class = ucfirst(self::$_config['lib_prefix']).ucfirst($load_class);
			return new $load_class;
		} else {
			$lib_file = _SYS_LIB_PATH.'/lib_'.$load_class.'.php';
			require_once $lib_file;
			$u_load_class = ucfirst($load_class);
			return self::$_lib[$load_class] = new $u_load_class;
		}
	}

}

?>
