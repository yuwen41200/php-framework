<?php

final class Template {
	public $view = NULL;
	public $data = array();
	public $result = NULL;
	
	public function init($_view, $_data) {
		$this -> view = $_view;
		$this -> data = $_data;
		$this -> result = $this -> fetchContents();
	}

	private function fetchContents() {
		$view_file = _VIEW_PATH.'/'.$this -> view.'.php';
		if (file_exists($view_file)) {
			extract($this -> data);
			ob_start();
			require $view_file;
			return ob_get_clean();
		}
		else
			return NULL;
	}

	public function output() {
		echo $this -> result;
	}
}

?>