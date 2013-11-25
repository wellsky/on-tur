<?
header("Content-Type: text/html; charset=utf-8");
include("config.php");
if ($_SESSION['debug']) {
	echo '<div style="border:1px dashed; padding:10px;">';
	echo nl2br('Ошибка: '.$_SESSION["error_message"]);
	echo '<br>';
	echo nl2br('URL: '.$_SESSION["url"]);
	echo '</div>';
	}
echo nl2br('Произошла ошибка или отказ доступа');	
?>
