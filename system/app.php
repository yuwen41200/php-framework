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
			'route' => _SYS_LIB_PATH.'/lib_route.php',
			'mysql'=> _SYS_LIB_PATH.'/lib_mysql.php',
			'template' => _SYS_LIB_PATH.'/lib_template.php',
			'cache' => _SYS_LIB_PATH.'/lib_cache.php',
			'thumbnail' => _SYS_LIB_PATH.'/lib_thumbnail.php'
		);
		require_once _SYS_CORE_PATH.'/model.php';
		require_once _SYS_CORE_PATH.'/controller.php';
	}

	public static function load() {
		foreach (self::$_lib as $key => $value) {
			require_once self::$_lib[$key];
			self::$_lib[$key] = new ucfirst($key);
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

	public static function run(){
		self::init();
		self::load();
		self::$_lib['route'] -> setUrlType(self::$_config['route_url_type']);
		$url_array = self::$_lib['route'] -> getUrlArray();
		self::routeToController($url_array);
	}
}

?>