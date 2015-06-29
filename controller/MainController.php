<?php

class MainController extends Controller {

	public function index() {
		echo "Debug message: action 'index' in controller 'main'<br>\n";
		echo "Info: try other available actions 'testDatabases', 'testSample', 'testHome'<br>\n";
		echo "Info: or try other available controllers 'database', 'main' in app 'simple_cache'<br>\n";
	}

	public function testDatabases() {
		$mod = $this -> model('main');
		$mod -> testing();
		$mod -> show();
	}

	public function testSample() {
		$lib = $this -> lib('sample', FALSE);
		$lib -> sampleRun();
	}

	public function testHome() {
		$data['article_1'] = "Debug message: print 'article_1'<br>\n";
		$data['article_2'] = "Debug message: print 'article_2'<br>\n";
		$this -> template('main', $data);
	}

}

?>
