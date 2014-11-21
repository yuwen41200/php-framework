<?php

final class Mysql {
	private $host = NULL;
	private $usr = NULL;
	private $pwd = NULL;
	private $db = NULL;
	private $conn_type = NULL;
	private $charset = NULL;
	public $conn = NULL;

	public function init($_host, $_usr, $_pwd, $_db, $_conn_type, $_charset) {
		$this -> host = $_host;
		$this -> usr = $_usr;
		$this -> pwd = $_pwd;
		$this -> db = $_db;
		$this -> conn_type = $_conn_type;
		$this -> charset = $_charset;
		$this -> connect();
	}

	public function connect() {
		$host_param = empty($this -> conn_type) ? $this -> host : $this -> conn_type . $this -> host;
		$this -> conn = new mysqli($host_param, $this -> usr, $this -> pwd, $this -> db);
		if ($this -> conn -> connect_error)
			die('MySQL Error: ('.$this -> conn -> connect_errno.') '.$this -> conn -> connect_error);
		$this -> conn -> set_charset($this -> charset);
	}

	public function disconnect() {
		$this -> conn -> close();
	}

	public function showDatabases() {
		$result = $this -> conn -> query("SHOW DATABASES") or die('MySQL Error: '.$this -> conn -> error);
		echo "All databases on the MySQL server:<br>\n";
		$count = 1;
		while ($row = $result -> fetch_assoc()) {
			echo "($count) $row[Database]<br>\n";
			$count++;
		}
		echo "Total databases: $result->num_rows<br>\n";
		$result -> free();
	}

	public function showTables() {
		$result = $this -> conn -> query("SHOW TABLES") or die('MySQL Error: '.$this -> conn -> error);
		echo "All tables in database '$this->db'<br>\n";
		$count = 1;
		$column = "Tables_in_$this->db";
		while ($row = $result -> fetch_assoc()) {
			echo "($count) $row[$column]<br>\n";
			$count++;
		}
		echo "Total tables: $result->num_rows<br>\n";
		$result -> free();
	}

	public function changeDatabase($new_db) {
		$this -> conn -> select_db($new_db) or die('MySQL Error: '.$this -> conn -> error);
		$tihs -> db = new_db;
	}

	public function select($column, $table, $condition = NULL, $limitation = NULL, $order = NULL) {
		$query = "SELECT $column FROM $table";
		if ($condition)
			$query .= " WHERE $condition";
		if ($limitation)
			$query .= " LIMIT $limitation";
		if ($order)
			$query .= " ORDER BY $order";
		$this -> conn -> query($query) or die('MySQL Error: '.$this -> conn -> error);
	}

	public function delete($table, $condition, $safe = TRUE) {
		$query = "DELETE FROM $table WHERE $condition";
		if ($safe)
			$query .= " LIMIT 1";
		$this -> conn -> query($query) or die('MySQL Error: '.$this -> conn -> error);
	}

	public function insert($table, $column, $value) {
		$query = "INSERT INTO $table ($column) VALUES ($value)";
		$this -> conn -> query($query) or die('MySQL Error: '.$this -> conn -> error);
	}

	public function update($table, $modification, $condition, $safe = TRUE) {
		$query = "UPDATE $table SET $modification WHERE $condition";
		if ($safe)
			$query .= " LIMIT 1";
		$this -> conn -> query($query) or die('MySQL Error: '.$this -> conn -> error);
	}

	public function checkValues($value_array) {
		foreach ($value_array as $key => $value) {
			$value_array[$key] = htmlentities($value_array[$key], ENT_QUOTES, 'UTF-8');
			$value_array[$key] = $this -> conn -> real_escape_string($value_array[$key]);
			$value_array[$key] = ($value_array[$key] == "") ? "NULL" : "'$value'";
		}
		return $value_array;
	}
}

?>