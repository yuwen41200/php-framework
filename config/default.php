<?php

return array(
	'db_host' => 'localhost',
	'db_user' => 'root',
	'db_password' => '',
	'db_database' => 'app',
	'db_table_prefix' => 'app_',
	'db_charset' => 'urf8',
	'db_conn' => '', # set the value to 'pconn' for persistent connection

	'lib_prefix' => 'ext',

	'route_default_controller' => 'home',
	'route_default_action' => 'index',
	'route_url_type' => 1, # for value 1, it will be 'index.php?controller=m&action=n&id=k'
			          # for value 2, it will be 'index.php/m/n/id/k'

	'cache_dir' => 'cache',
	'cache_prefix' => 'cache_',
	'cache_time' => 1800,
	'cache_mode' => 2 # for value 1, it will serialize; for value 2, it will save as exacutable files
);

?>