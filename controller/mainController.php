<?php

class mainController extends Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		echo "Debug message: action 'index' in controller 'mainController'<br>\n";
		echo "Info: try other available actions 'testDatabases', 'testSample', 'testHome'<br>\n";
	}

	public function testDatabases() {
		$mod = $this -> model('main');
		$result = $mod -> show();
		var_dump($result);
	}

	public function testSample() {
		$obj = $this -> lib('sample', FALSE);
		$obj -> sampleRun();
	}

	public function testHome() {
		$data['article_1'] = "Debug message: print 'article_1'<br>\n";
		$data['article_2'] = "Debug message: print 'article_2'<br>\n";
		$this -> template('home', $data);
	}
}

?>