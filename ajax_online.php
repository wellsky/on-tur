<?php
//error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");

include("_start.php");

echo '<base href="'.$config_folder_index.'/" />';
Debug('Debug is enabled');

$menu_select=9002;

/*
$_name=mysql_real_escape_string($_POST['order_name']);
$_secondname=mysql_real_escape_string($_POST['order_secondname']);
$_email=mysql_real_escape_string($_POST['order_email']);
$_phone=mysql_real_escape_string($_POST['order_phone']);
$_subject=mysql_real_escape_string($_POST['order_subject']);
$_text=mysql_real_escape_string($_POST['order_text']);
*/

$_tour=mysql_real_escape_string($_GET['tour']);

if ($_tour) {
	$query="SELECT * FROM tours WHERE id=".$_tour;
	if (!$tour=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
	$tour_row=mysql_fetch_array($tour);
	$html_tour=$tour_row['name'].' - заказать';
} else {
	$html_tour='ЗАКАЗАТЬ ТУР';
}

$config_title='Потомский';
?>

<!DOCTYPE HTML>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="style.css">
</head>


<?php						
echo '
	<div class="box-modal" style="width:450px;">
		<div style="margin:20px; font:14px Arial; color:#666; background-color:#fff;">
							<h2>'.$html_tour.'</h2>
							<form id="send" action="send" method="POST" enctype="multipart/form-data">
							Телефон:<br>
							<input id="input_phone" type=text name="order_phone" style="width:400px;" value="'.$_phone.'">
							<br><span class="hint">Контактный телефон <span style="color:#f00;">(обязательно)</span></span>
							<br><br>
							ФИО:<br>
							<input id="input_name" type=text name="order_name" style="width:400px;" value="'.$_name.'">
							<br><span class="hint">Представтесь, как к Вам обращаться</span>
							<br><br>
							Контактный e-mail:<br>
							<input id="input_email" type=text name="order_mail"  style="width:400px;" value="'.$_email.'">
							<br><span class="hint">Адрес электронной почты для связи</span>
							<br><br>
							Ваши пожелания:<br>
							<textarea id="input_text" name="order_text" cols=48 rows=8>'.$_text.'</textarea>
							<br><span class="hint">Напишите нам любые пожелания по Вашему туру</span>
							<br><br>
							<input type="button" value="Отправить" style="width:100px;"
								onClick="javascript:if (document.getElementById(\'input_phone\').value==\'\') { 
														alert(\'Необходимо ввести телефон\');
													} else {
														alert(\'В ближайшее время мы свяжемся с Вами\');
													}
										"
							>
							</form>
		</div>
	<div class="box-modal_close arcticmodal-close">[закрыть]</div>
	</div>
';
?>		
