<?php
//error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");

include("_start.php");
include("well_config.php");

if ($_SESSION['user_type']<>2) {
header('Location: '.'wl_login.php');
exit;
}

echo '<base href="'.$config_folder_index.'/" />';
//Debug('Debug is enabled');

$_id=mysql_real_escape_string($_GET['id']);
$_object=mysql_real_escape_string($_GET['object']);
$_action=mysql_real_escape_string($_GET['action']);
$_column_prefix=mysql_real_escape_string($_GET['column_prefix']); 
// На стадии тестирования. При вызове окна редактирования с параметром column_prefix в GET, ко всем столбцам, 
// для которых в well_config параметр use_prefix=true при сохранении будет добавлен этот префикс.
// Использовалось для поддержки нескольких языков. Кажый язык записывался в столбцы со своим префиксом.

if ($_action=='edit') {
	$query="SELECT * FROM `".$config_well_object[$_object]['table']."` WHERE id=".$_id;
	if (!$result=mysql_query($query)) {$error=1;$error_msg='Ошибка: Не удалось загрузить данные из базы<br>Ошибка: '.mysql_error().'<br>Запрос: '.$query;}
	$objects_row=mysql_fetch_array($result);
}

if ($config_well_object[$_object]['width']) {
	$html_width='width:'.$config_well_object[$_object]['width'].'px;';
}

if ($_action=='logout') {
	$_SESSION['adm_url']='';
	$_SESSION['adm_menu1']=1;
	$_SESSION['adm_menu2']=1;

	$_SESSION['user_id']=0;
	$_SESSION['user_type']=0;
	$_SESSION['user_nickname']='';
	$_SESSION['user_avatar']='';
	$_SESSION['avatar']='';
	$_SESSION['adm_trytologin']=false;
	
	echo '
	<div class="box-modal" style="width:300px; text-align:center;">
		Вы вышли<br><br>
		<a href="'.$_SESSION['url'].'">Закрыть</a>
	</div>
	';
	exit;
}

?>

<script>
$(document).ready(function(){
$('#submit_id').click(function(e){
	e.preventDefault();
	alert('ddd');

});
});
</script>


<?php
echo '
	<div style="margin:20px; width:600px; font:14px Arial; color:#666;">
		<span style="font:22px Arial; color:#000; display:block; margin-bottom:20px;">'.$config_well_object[$_object]['name'].'</span>';
	
		if ($error) {
			echo $error_msg;
		}
		
		echo '<form action="well_save.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="object" value="'.$_object.'">
				<input type="hidden" name="id" value="'.$_id.'">
				<input type="hidden" name="action" value="'.$_action.'">
				<input type="hidden" name="column_prefix" value="'.$_column_prefix.'">
				';
		
		foreach ($_GET as $key=>$value) {
			if (subStr($key,0,6)=='field_') {
				$row=subStr($key,6,strlen($key));
				echo '<input type="hidden" name="field_'.$row.'" value="'.$value.'">';
			}
		}
			
		//Поля таблицы
		if ($config_well_object[$_object]['fields']) {
			foreach($config_well_object[$_object]['fields'] as $column=>$value) {
				if ($value['use_prefix']==true) {$current_column_prefix=$_column_prefix;} else {$current_column_prefix='';}
				//echo $current_column_prefix;
				
				if (($value['type']=='string') and (!$value['hide'])) {
					echo $value['title'].':<br>';
					echo '<input type=text size=64 name="additional_'.$current_column_prefix.$column.'" value="'.htmlspecialchars($objects_row[$current_column_prefix.$column]).'"><br><br>';
				}

				if ($value['type']=='text') {
					$html_id='';
					$html_height='height:200px;';
					if ($value['wysiwyg']) {
						$html_id='id="redactor"';
					}
					if ($value['height']) {
						$html_height='height:'.$value['height'].'px;';
					}
					echo $value['title'].':<br>';
					echo '<textarea style="width:100%; '.$html_height.'" name="additional_'.$current_column_prefix.$column.'" '.$html_id.'>'.$objects_row[$current_column_prefix.$column].'</textarea><br><br>';
				}

				if ($value['type']=='newdatetime') {
					echo $value['title'].':<br>';
					$time=$objects_row[$current_column_prefix.$column];
					if (!$time) {
						$time=date("Y-m-d H:i:s");
						}
					if ($value['hide']==false) {
						echo '<input type=text size=64 name="additional_'.$current_column_prefix.$column.'" value="'.$time.'"><br><br>';
						}
				}

				
				if ($value['type']=='select') {
					if ($value['select_table']) {
						$query="SELECT * FROM ".$value['select_table'];
						if (!$select=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
						echo $value['title'].':<br>
						<select name="additional_'.$current_column_prefix.$column.'">
							<option value="0">Не выбрано</option>';
							while ($select_row=mysql_fetch_array($select)) {
								if ($objects_row[$current_column_prefix.$column]==$value['select_mask1'].$select_row['id'].$value['select_mask2']) {
									$html_selected="selected";
								} else {
									$html_selected="";
								}
								echo '<option value="'.$select_row['id'].'" '.$html_selected.'>'.$select_row[$value['select_name']].'</option>';
							}
						echo '</select><br><br>';	
					}
				}
				
				if ($value['type']=='checkbox') {
					if ($objects_row[$current_column_prefix.$column]) {
						$html_checked='checked';
					} else {
						$html_checked='';
					}
					echo '<input type="checkbox" name="additional_'.$current_column_prefix.$column.'" '.$html_checked.' style="margin-left:0px;"><span class="inline" style="margin-top:2px;">&nbsp;&nbsp;'.$value['title'].'</span><br><br>';
				}
				
				if ($value['type']=='image') {
					echo $value['title'].':<br>';
					echo '<input type="hidden" name="file_'.$current_column_prefix.$column.'" value="1">';
					echo '<input type="file" style="width:150px; margin-bottom:10px;" name="file_'.$current_column_prefix.$column.'"><br><br>';
				}

				if ($value['type']=='file') {
					echo $value['title'].':<br>';
					echo '<input type="hidden" name="file_'.$current_column_prefix.$column.'" value="1">';
					echo '<input type="file" style="width:150px; margin-bottom:10px;" name="file_'.$current_column_prefix.$column.'"><br><br>';
				}
				
			}
		}		
		echo '
		<input type="submit" value="Сохранить">';
			if (($config_well_object[$_object]['allowdelete']) and ($_action<>'add')) {
					echo '&nbsp;<input type="submit" name="deleteobject" value="Удалить">';
			}
		echo'
		</form>
		';

		
	echo '
	</div>
';
?>