<?php

return array(
	'db_host' => 'dbhome.cs.nctu.edu.tw',
	'db_user' => 'ywpu_cs',
	'db_password' => '',
	# DANGER: DO NOT ACCIDENTALLY COMMIT THE PASSWORD ONTO GITHUB!
	'db_database' => 'ywpu_cs',
	'db_table_prefix' => 'web_',
	'db_charset' => 'utf8mb4_general_ci',
	'db_conn_type' => '',
	# Set the value to 'p:' for persistent connection, '' otherwise.
	'lib_prefix' => 'lib',
	'route_default_controller' => 'main',
	'route_default_action' => 'index',
	'route_url_type' => 2,
	# For value 1, the URL should be 'index.php?app=p&ctl=q&act=r&others=s'.
	# For value 2, the URL should be 'index.php/app/p/ctl/q/act/r/others/s'.
	'web_root' => '',
	# If the value is an empty string, it will be automatically set by the application.
	'cache_dir' => 'cache',
	'cache_prefix' => 'cache_',
	'cache_time' => 1800,
	'cache_mode' => 2,
	# For value 1, the cache will be serialized; for value 2, it will be saved as an executable file.
	'app_version' => '2.0'
);

?>
