<?php

class dbOperationController extends Controller {
	private $table = 'framework_test';

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$mod = $this -> model('dbOperation');
		echo "Debug message: action 'index' in controller 'dbOperation'<br>\n";
		echo "Info: try other available actions 'insert'<br>\n";
		echo "<h3>Info: calling dbOperationModel::createTable()</h3>\n";
		$mod -> createTable($this -> table);
		echo "<h3>Info: calling dbOperationModel::listTables()</h3>\n";
		$mod -> listTables();
		echo "<h3>Info: calling dbOperationModel::verifyTable()</h3>\n";
		$mod -> verifyTable($this -> table);
		echo "<h3>Info: calling dbOperationModel::listRows()</h3>\n";
		$mod -> listRows($this -> table);
	}

	public function insert($params = array('content' => 'VALUE_UNSPECIFIED')) {
		$params['content'] = $params['content'] ? $params['content'] : 'VALUE_UNSPECIFIED';
		$mod = $this -> model('dbOperation');
		$mod -> insertRow($this -> table, $params);
	}
}

?>