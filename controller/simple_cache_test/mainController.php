<?php

class mainController extends Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$mod = $this -> model('main');
		$mod -> add("This is a sample data saved in cache 'example'<br>");
		$data['article_1'] = "Debug message: ";
		$data['article_1'] .= "action 'index' in controller 'main' in app 'simple_cache_test'<br>\n";
		$data['article_1'] .= "Info: try other available actions 'delete'<br>\n";
		$data['article_2'] = $mod -> display();
		$this -> template('home', $data);
	}

	public function delete() {
		$mod = $this -> model('main');
		$mod -> clear();
		echo "Debug message: cache deleted successfully<br>\n";
	}
}

?>