<?php

class DatabaseController extends Controller {

	private $table = 'framework_test';

	public function index() {
		$mod = $this -> model('database');
		echo "Debug message: action 'index' in controller 'database'<br>\n";
		echo "Info: try other available actions 'insert'<br>\n";
		echo "<i>Info: calling DatabaseModel::createTable()</i>\n";
		$mod -> createTable($this -> table);
		echo "<i>Info: calling DatabaseModel::listTables()</i>\n";
		$mod -> listTables();
		echo "<i>Info: calling DatabaseModel::verifyTable()</i>\n";
		$mod -> verifyTable($this -> table);
		echo "<i>Info: calling DatabaseModel::listRows()</i>\n";
		$mod -> listRows($this -> table);
	}

	public function insert($params = array('content' => 'VALUE_UNSPECIFIED')) {
		$params['content'] = $params['content'] ? $params['content'] : 'VALUE_UNSPECIFIED';
		$mod = $this -> model('database');
		$mod -> insertRow($this -> table, $params);
	}

}

?>
