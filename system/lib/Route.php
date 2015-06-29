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
		if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']!='') {
			parse_str($_SERVER['QUERY_STRING'], $url_query);
			$this -> processUrlArray($url_query);
		}
	}

	private function pathinfoToArray() {
		if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO']!='' && $_SERVER['PATH_INFO']!='/') {
			$url_pathinfo_exploded = explode('/', $_SERVER['PATH_INFO']);
			array_shift($url_pathinfo_exploded);
			foreach ($url_pathinfo_exploded as $key => $value)
				if (!($key%2) && $value!='')
					$url_pathinfo[$value] = array_key_exists($key+1, $url_pathinfo_exploded) ? $url_pathinfo_exploded[$key+1] : '';
			$this -> processUrlArray($url_pathinfo);
		}
	}

	private function processUrlArray($url_process) {
		if (isset($url_process['app'])) {
			$this -> url_array['app'] = $url_process['app'];
			unset($url_process['app']);
		} 
		if (isset($url_process['ctl'])) {
			$this -> url_array['ctl'] = $url_process['ctl'];
			unset($url_process['ctl']);
		}
		if (isset($url_process['act'])) {
			$this -> url_array['act'] = $url_process['act'];
			unset($url_process['act']);
		}
		if (count($url_process) > 0) {
			$this -> url_array['params'] = $url_process;
		}
	}

}

?>
