<?php

abstract class Model {

	protected $db = NULL;
	protected $cache = NULL;

	final public function __construct() {
		header('Content-type: text/html; charset=utf-8');
		$this -> db = $this -> lib('mysql');
		$this -> db -> init(
			$this -> config('db_host'),
			$this -> config('db_user'),
			$this -> config('db_password'),
			$this -> config('db_database'),
			$this -> config('db_conn_type'),
			$this -> config('db_charset')
		);
		$this -> cache = $this -> lib('cache');
	}

	final protected function table($table) {
		return $this -> config('db_table_prefix') . $table;
	}

	final protected function lib($lib, $is_system_lib = TRUE) {
		if (empty($lib))
			return NULL;
		elseif ($is_system_lib)
			return Application::$_lib[$lib];
		else
			return Application::loadCustomLib($lib);
	}

	final protected function config($config) {
		return Application::$_config[$config];
	}

}

?>
