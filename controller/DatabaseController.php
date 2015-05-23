<?php

class DatabaseController extends Controller {

	private $table = 'framework_test';

	public function index() {
		$mod = $this -> model('Database');
		echo "Debug message: action 'index' in controller 'Database'<br>\n";
		echo "Info: try other available actions 'insert'<br>\n";
		echo "<h3>Info: calling DatabaseModel::createTable()</h3>\n";
		$mod -> createTable($this -> table);
		echo "<h3>Info: calling DatabaseModel::listTables()</h3>\n";
		$mod -> listTables();
		echo "<h3>Info: calling DatabaseModel::verifyTable()</h3>\n";
		$mod -> verifyTable($this -> table);
		echo "<h3>Info: calling DatabaseModel::listRows()</h3>\n";
		$mod -> listRows($this -> table);
	}

	public function insert($params = array('content' => 'VALUE_UNSPECIFIED')) {
		$params['content'] = $params['content'] ? $params['content'] : 'VALUE_UNSPECIFIED';
		$mod = $this -> model('Database');
		$mod -> insertRow($this -> table, $params);
	}

}

?>
