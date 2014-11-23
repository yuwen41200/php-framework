<?php

class mainModel extends Model {
	function add($content = 'VALUE_UNSPECIFIED') {
		$this -> cache -> push('example', $content);
	}

	function display() {
		return $this -> cache -> pull('example');
	}

	function clear() {
		$this -> cache -> flush();
	}
}

?>