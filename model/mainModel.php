<?php

class mainModel extends Model {
	function testing() {
		echo "Debug message: mainModel::testing() called<br>\n";
	}
	
	function show() {
		$this -> db -> show_databases();
	}
}

?>