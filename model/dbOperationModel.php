<?php

class dbOperationModel extends Model {
	function createTable($table) {
		$table_name = $this -> table($table);
		$this -> db -> query(<<<SYNTAX
CREATE TABLE IF NOT EXISTS $table_name (
	id INT(20) NOT NULL AUTO_INCREMENT,
	content VARCHAR(20) NOT NULL,
	time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci
SYNTAX
		);
		echo "Debug message: table created successfully<br>\n";
	}

	function listTables() {
		$result = $this -> db -> showTables();
		echo $result;
	}

	function verifyTable($table) {
		$table_name = $this -> table($table);
		$result = $this -> db -> describeTable($table_name);
		echo $result;
	}

	function listRows($table) {
		$column = '*';
		$table_name = $this -> table($table);
		$order = 'id ASC';
		$result = $this -> db -> select($column, $table_name, NULL, NULL, $order);
		$date = "date";
		echo "<table><tr><td colspan='3'>All rows in table '$table_name'</td></tr>\n";
		echo "<tr><td>id</td>";
		echo "<td>content</td>";
		echo "<td>time</td></tr>\n";
		while ($row = $result -> fetch_assoc()) {
			echo "<tr><td>$row[id]</td>";
			echo "<td>$row[content]</td>";
			echo "<td>{$date('M j Y g:i A', strtotime($row[time]))}</td></tr>\n";
		}
		echo "<tr><td colspan='3'>Total rows: $result->num_rows</td></tr></table>\n";
		$result -> free();
	}

	function insertRow($table, $params) {
		$table_name = $this -> table($table);
		$column = 'content';
		$params = $this -> db -> checkValues($params);
		$value = $params['content'];
		$this -> db -> insert($table_name, $column, $value);
		header("Refresh: 5; url=http://people.cs.nctu.edu.tw/~ywpu/php-framework/index/controller/dbOperation");
		echo "Debug message: row inserted successfully<br>\n";
		exit;
	}
}

?>