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
		$output = "<table><tr><td colspan='2'>All databases on the MySQL server</td></tr>\n";
		$count = 1;
		while ($row = $result -> fetch_assoc()) {
			$output .= "<tr><td>($count)</td>";
			$output .= "<td>$row[Database]</td></tr>\n";
			$count++;
		}
		$output .= "<tr><td colspan='2'>Total databases: $result->num_rows</td></tr></table>\n";
		$result -> free();
		return $output;
	}

	public function showTables() {
		$result = $this -> conn -> query("SHOW TABLES") or die('MySQL Error: '.$this -> conn -> error);
		$output = "<table><tr><td colspan='2'>All tables in database '$this->db'</td></tr>\n";
		$count = 1;
		$column = "Tables_in_$this->db";
		while ($row = $result -> fetch_assoc()) {
			$output .= "<tr><td>($count)</td>";
			$output .= "<td>$row[$column]</td></tr>\n";
			$count++;
		}
		$output .= "<tr><td colspan='2'>Total tables: $result->num_rows</td></tr></table>\n";
		$result -> free();
		return $output;
	}

	public function selectDatabase($new_db) {
		$this -> conn -> select_db($new_db) or die('MySQL Error: '.$this -> conn -> error);
		$tihs -> db = $new_db;
	}

	public function describeTable($table) {
		$query = "SHOW FULL COLUMNS FROM $table";
		$result = $this -> conn -> query($query) or die('MySQL Error: '.$this -> conn -> error);
		$output = "<table><tr><td colspan='9'>Descriptions of table '$table'</td></tr>\n";
		$output .= "<tr><td>Field</td>";
		$output .= "<td>Type</td>";
		$output .= "<td>Collation</td>";
		$output .= "<td>Null</td>";
		$output .= "<td>Key</td>";
		$output .= "<td>Default</td>";
		$output .= "<td>Extra</td>";
		$output .= "<td>Privileges</td>";
		$output .= "<td>Comment</td></tr>\n";
		while ($row = $result -> fetch_assoc()) {
			$output .= "<tr><td>$row[Field]</td>";
			$output .= "<td>$row[Type]</td>";
			$output .= "<td>$row[Collation]</td>";
			$output .= "<td>$row[Null]</td>";
			$output .= "<td>$row[Key]</td>";
			$output .= "<td>$row[Default]</td>";
			$output .= "<td>$row[Extra]</td>";
			$output .= "<td>$row[Privileges]</td>";
			$output .= "<td>$row[Comment]</td></tr>\n";
		}
		$output .= "<tr><td colspan='9'>Total columns: $result->num_rows</td></tr></table>\n";
		$result -> free();
		return $output;
	}

	public function select($column, $table, $condition = NULL, $limitation = NULL, $order = NULL) {
		$query = "SELECT $column FROM $table";
		if ($condition)
			$query .= " WHERE $condition";
		if ($limitation)
			$query .= " LIMIT $limitation";
		if ($order)
			$query .= " ORDER BY $order";
		$result = $this -> conn -> query($query) or die('MySQL Error: '.$this -> conn -> error);
		return $result;
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

	public function query($query) {
		$this -> conn -> query($query) or die('MySQL Error: '.$this -> conn -> error);
	}

	public function checkValues($value_array) {
		foreach ($value_array as $key => $value) {
			$value_array[$key] = htmlentities((string) $value_array[$key], ENT_QUOTES, 'UTF-8');
			$value_array[$key] = $this -> conn -> real_escape_string($value_array[$key]);
			$value_array[$key] = ($value_array[$key] == "") ? "NULL" : "'$value_array[$key]'";
		}
		return $value_array;
	}

}

?>
