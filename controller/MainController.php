<?php

class MainController extends Controller {

	public function index() {
		echo "Debug message: action 'index' in controller 'Main'<br>\n";
		echo "Info: try other available actions 'testDatabases', 'testSample', 'testHome'<br>\n";
		echo "Info: or try other available controllers 'Database', 'Main' in app 'simple_cache'<br>\n";
	}

	public function testDatabases() {
		$mod = $this -> model('Main');
		$mod -> testing();
		$mod -> show();
	}

	public function testSample() {
		$obj = $this -> lib('sample', FALSE);
		$obj -> sampleRun();
	}

	public function testHome() {
		$data['article_1'] = "Debug message: print 'article_1'<br>\n";
		$data['article_2'] = "Debug message: print 'article_2'<br>\n";
		$this -> template('main', $data);
	}

}

?>
