<?php
	$db = mysql_connect($config_db_host,$config_db_user,$config_db_pass);
	mysql_query("SET NAMES UTF8");

	if (!$db)
	{
	print "Error - Could not connect to MySQL";
	exit;
	}

	$er = mysql_select_db($config_db_name);
	if(!$er)
	{
	print "Error - Could not select the database";
	exit;
	}

?>