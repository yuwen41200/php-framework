<?php

class MainController extends Controller {

	public function index() {
		$mod = $this -> model('Main');
		$mod -> add("This is a sample data saved in cache 'example'<br>");
		$data['article_1'] = "Debug message: ";
		$data['article_1'] .= "action 'index' in controller 'Main' in app 'simple_cache'<br>\n";
		$data['article_1'] .= "Info: try other available actions 'delete'<br>\n";
		$data['article_2'] = $mod -> display();
		$this -> template('main', $data);
	}

	public function delete() {
		$mod = $this -> model('Main');
		$mod -> clear();
		echo "Debug message: cache deleted successfully<br>\n";
	}

}

?>
