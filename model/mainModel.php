<?php

class mainModel extends Model {
	function testing() {
		echo "Debug message: mainModel::testing() called<br>\n";
	}
	
	function show() {
		$result = $this -> db -> showDatabases();
		echo $result;
	}
}

?>