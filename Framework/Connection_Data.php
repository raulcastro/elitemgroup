<?php
	
	if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1')
	{
		define ('DB_HOST', '127.0.0.1');
		define ('DB_USER', 'root');
		define ('DB_PASS', 'cas8867ca');
		define ('DB_NAME', 'db161140_elite');
	}
	else
	{
// 		define ('DB_HOST', 'internal-db.s161140.gridserver.com');
// 		define ('DB_USER', 'db161140_2go');
// 		define ('DB_PASS', 'where2GO');
// 		define ('DB_NAME', 'db161140_elite');
		
		define ('DB_HOST', '127.0.0.1');
		define ('DB_USER', 'root');
		define ('DB_PASS', 'cas8867ca');
		define ('DB_NAME', 'db161140_elite');
	}
	
	