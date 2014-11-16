<?php

class Model {
	protected $db = NULL;

	final public function __construct() {
		header('Content-type: text/html; chartset=utf-8');
		$this -> db = $this -> lib('mysql');
		$this -> db -> init(
			$this -> config('db_host'),
			$this -> config('db_user'),
			$this -> config('db_password'),
			$this -> config('db_database'),
			$this -> config('db_conn'),
			$this -> config('db_charset')
		);
	}

	final protected function table($table) {
		$table .= $this -> config('db_table_prefix');
		return $table;
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