<?php

final class Route {
	public $url_type = NULL;
	public $url_array = array();

	public function setUrlType($url_type) {
		switch ($url_type) {
			case 1:
				$this -> url_type = 1;
				break;
			case 2:
				$this -> url_type = 2;
				break;
			default:
				$this -> url_type = 1;
				break;
		}
	}

	public function getUrlArray() {
		switch ($this -> url_type) {
			case 1:
				$this -> querytToArray();
				break;
			case 2:
				$this -> pathinfoToArray();
				break;
		}
		return $this -> url_array;
	}

	private function querytToArray() {
		parse_str($_SERVER['QUERY_STRING'], $url_query);
		$this -> processUrlArray($url_query);
	}

	private function pathinfoToArray() {
		$url_pathinfo_exploded = explode('/', $_SERVER['PATH_INFO']);
		array_shift($url_pathinfo_exploded);
		foreach ($url_pathinfo_exploded as $key => $value) {
			if (!($key%2))
				$url_pathinfo[$value] = $url_pathinfo_exploded[$key+1];
		}
		$this -> processUrlArray($url_pathinfo);
	}

	private function processUrlArray($url_process) {
		if (isset($url_process['app'])) {
			$this -> url_array['app'] = $url_process['app'];
			unset($url_process['app']);
		} 
		if (isset($url_process['controller'])) {
			$this -> url_array['controller'] = $url_process['controller'];
			unset($url_process['controller']);
		}
		if (isset($url_process['action'])) {
			$this -> url_array['action'] = $url_process['action'];
			unset($url_process['action']);
		}
		if (count($url_process) > 0) {
			$this -> url_array['params'] = $url_process;
		}
	}
}

?>