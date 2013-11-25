<?php
//error_reporting(E_ALL);
//header("Content-Type: text/html; charset=utf-8");

$no_java=true;
include("_start.php");

if ($_GET['action']=='logout') {
	$_SESSION['adm_url']='';
	$_SESSION['adm_menu1']=1;
	$_SESSION['adm_menu2']=1;

	$_SESSION['user_id']=0;
	$_SESSION['user_type']=0;
	$_SESSION['user_nickname']='';
	$_SESSION['user_avatar']='';
	$_SESSION['avatar']='';
	$_SESSION['adm_trytologin']=false;
	
	header('Location: '.$_SESSION['url']);
}

if ($_POST['user_login']<>'') {
	$_name=mysql_real_escape_string(iconv('utf-8', 'cp1251', $_POST['user_login']));
	$query="SELECT * FROM users WHERE login='".$_name."'";
	if (!$users=mysql_query($query)) {ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
	$users_num_rows=mysql_num_rows($users);
	$users_row=mysql_fetch_array($users);
	
	
	if ($error==0) {
		if (($users_num_rows==0) or ($users_row['password']<>md5($_POST['user_password']))) {
			$error=1; // Неверный пароль или прользователь не найден
		} 
	}

	if ($error==0) {
		$_SESSION['adm_url']=$config_folder_adm.'/adm_index.php';
		$_SESSION['user_id']=$users_row['id'];
		$_SESSION['user_type']=$users_row['usertype'];
		$_SESSION['user_nickname']=$users_row['nickname'];
		$_SESSION['user_avatar']=$users_row['avatar'];
		$_SESSION['avatar']=$config_folder_upload.'/avatar/'.$_SESSION['user_avatar'];
		$error=0;
		//WriteLog($users_row['id'],1,0,$_SESSION["url"]);
	}
	
	if ($error==0) {
		header('Location: '.$_SESSION['url']);
	} else {
		header('Location: well_login.php');
	}
} else {
	echo '
	<table width=100%, height=80%><tr><td style="text-align:center;">
	<form action="well_login.php" method="POST">
				<img src="images//wellcms.jpg"><br><br>
				Логин:<br>
				<input type=text name="user_login"><br>
				Пароль:<br>
				<input type=password name="user_password"><br>
				<input type="submit" value="Войти">
	</form>
	</tr></td></table>
	
	';
}


?>