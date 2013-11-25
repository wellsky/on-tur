<?php
error_reporting(0);
header("Content-Type: text/html; charset=utf-8");

include("_start.php");

if ($_SESSION['user_type']<>2) {
header('Location: '.'wl_login.php');
exit;
}

$data=json_decode($_POST['content'],true);


foreach ($data as $key=>$value) {
	$params=explode("@", $key);
	echo $key;
	if ($params[0]=='direct') { // Напрямую указано место для сохранения (таблица,столбец,id)
		$query="UPDATE `".$params[1]."` SET `".$params[2]."`='".$value['value']."' WHERE id='".$params[3]."'";
		echo $query;
		if (!$result=mysql_query($query)){echo mysql_error().'<br><br>Запрос:'.$query;}
	}
}

//echo '<pre>';
//print_r($data);
//print_r($_POST['content']);
//echo '</pre>';



?>
