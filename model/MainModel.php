<?php

class MainModel extends Model {

	function testing() {
		echo "Debug message: MainModel::testing() called<br>\n";
	}
	
	function show() {
		$result = $this -> db -> showDatabases();
		echo $result;
	}

}

?>
