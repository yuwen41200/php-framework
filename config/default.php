<?php

return array(
	'db_host' => '',
	'db_user' => '',
	'db_password' => '',
	# DANGER: DO NOT ACCIDENTALLY COMMIT THE PASSWORD ONTO GITHUB!
	'db_database' => '',
	'db_table_prefix' => 'web_',
	'db_charset' => 'utf8mb4_general_ci',
	'db_conn_type' => '',
	# Set the value to 'p:' for persistent connection, '' otherwise.
	'lib_prefix' => 'ext',
	'route_default_controller' => 'Main',
	'route_default_action' => 'index',
	'route_url_type' => 2,
	# For value 1, it will be 'index.php?ctl=m&act=n&id=k'.
	# For value 2, it will be 'index.php/ctl/m/act/n/id/k'.
	'web_root' => '/',
	# If the path is 'http://www.example.net/foo/bar/', set the value to '/foo/bar/'.
	'cache_dir' => 'cache',
	'cache_prefix' => 'cache_',
	'cache_time' => 1800,
	'cache_mode' => 2
	# For value 1, it will be serialized; for value 2, it will be saved as exacutable files.
);

?>
