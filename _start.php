<?php
session_start();

if(!isset($_SESSION["error_message"])) {
	$_SESSION["error_message"]='';
}

if(!isset($_SESSION["user_type"])) {
	$_SESSION["user_type"]=0;
}

include('_config-host.php');

include("_functions_php.php");
include("well_func_php.php");

include("_sql_connect.php");

if (!$no_java) {
include("_functions_java.php");
}
?>