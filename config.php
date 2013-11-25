<?php
session_start();

if(!isset($_SESSION["error_message"])) {
	$_SESSION["error_message"]='';
}

if(!isset($_SESSION["user_type"])) {
	$_SESSION["user_type"]=0;
}

include('_config-host.php');
?>