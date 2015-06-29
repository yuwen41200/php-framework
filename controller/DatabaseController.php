<?php

class DatabaseController extends Controller {

	private $table = 'framework_test';

	public function index() {
		$mod = $this -> model('database');
		echo "Debug message: action 'index' in controller 'database'<br>\n";
		echo "Info: try other available actions 'insert'<br>\n";
		echo "<h1>Info: calling DatabaseModel::createTable()</h1>\n";
		$mod -> createTable($this -> table);
		echo "<h1>Info: calling DatabaseModel::listTables()</h1>\n";
		$mod -> listTables();
		echo "<h1>Info: calling DatabaseModel::verifyTable()</h1>\n";
		$mod -> verifyTable($this -> table);
		echo "<h1>Info: calling DatabaseModel::listRows()</h1>\n";
		$mod -> listRows($this -> table);
	}

	public function insert($params = array('content' => 'VALUE_UNSPECIFIED')) {
		$params['content'] = $params['content'] ? $params['content'] : 'VALUE_UNSPECIFIED';
		$mod = $this -> model('database');
		$mod -> insertRow($this -> table, $params);
	}

}

?>
