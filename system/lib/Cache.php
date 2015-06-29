<?php

final class Cache {

	private $dir = NULL;
	private $prefix = NULL;
	private $time = NULL;
	private $mode = NULL;

	public function init($_dir, $_prefix, $_time, $_mode) {
		$this -> dir = $_dir;
		$this -> prefix = $_prefix;
		$this -> time = $_time;
		$this -> mode = $_mode;
	}

	public function push($id, $data) {
		if ($this -> existCache($id))
			$this -> remove($id);
		$this -> writeCache($id, $data);
	}

	public function pull($id) {
		if ($this -> existCache($id))
			return $this -> readCache($id);
		else
			return NULL;
	}

	public function remove($id) {
		if ($this -> existCache($id)) {
			$path = $this -> dir.'/'.$this -> prefix.$id.'.php';
			unlink($path);
		}
	}

	public function flush() {
		$path = $this -> dir.'/'.$this -> prefix.'*.php';
		$result = glob($path);
		foreach ($result as $item) {
			unlink($item);
		}
	}

	private function existCache($id) {
		$path = $this -> dir.'/'.$this -> prefix.$id.'.php';
		if (file_exists($path))
			if (time() > filemtime($path) + $this -> time)
				unlink($path);
		return file_exists($path) ? TRUE : FALSE;
	}

	private function writeCache($id, $data) {
		$path = $this -> dir.'/'.$this -> prefix.$id.'.php';
		if (!is_dir($this -> dir))
			mkdir($this -> dir, 0777);
		if (!is_writable($this -> dir))
			chmod($this -> dir, 0777);
		if ($this -> mode == 1)
			$data = serialize($data);
		else
			$data = "<?php\nreturn ".var_export($data, TRUE).";\n?>\n";
		$file = fopen($path, 'w');
		flock($file, LOCK_EX);
		ftruncate($file, 0);
		fwrite($file, $data);
		fflush($file);
		flock($file, LOCK_UN);
		fclose($file);
		chmod($path, 0777);
	}

	private function readCache($id) {
		$path = $this -> dir.'/'.$this -> prefix.$id.'.php';
		if ($this -> mode == 1) {
			$file = fopen($path, r);
			$data = fread($file, filesize($path));
			fclose($file);
			touch($path);
			return unserialize($data);
		} else {
			touch($path);
			return include $path;
		}
	}

}

?>
