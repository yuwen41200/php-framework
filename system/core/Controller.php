<?php

abstract class Controller {

	final public function __construct() {
		header('Content-type: text/html; charset=utf-8');
	}

	final protected function model($model) {
		if (empty($model))
			return NULL;
		$model = ucfirst($model).'Model';
		return new $model;
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

	final protected function template($path, $data) {
		$template = $this -> lib('template');
		$template -> init($path, $data);
		$template -> output();
	}

	abstract public function index();

}

?>
