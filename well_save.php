<?php
error_reporting(0);
header("Content-Type: text/html; charset=utf-8");

include("_start.php");
include("well_config.php");

if ($_SESSION['user_type']<>2) {
header('Location: '.'wl_login.php');
exit;
}

echo '<base href="'.$config_folder_index.'/" />';
//Debug('Debug is enabled');

$_id=mysql_real_escape_string($_POST['id']);
$_object=mysql_real_escape_string($_POST['object']);
$_action=mysql_real_escape_string($_POST['action']);
$_deleteobject=mysql_real_escape_string($_POST['deleteobject']);
$_column_prefix=mysql_real_escape_string($_POST['column_prefix']); 



											function well_img_resize_square($_file_tmp_name,$_patch,$_size) {
												   $w=$_size;// Размер
												   $q=100;// Качество
												   //$avatarname=$_id.'.jpg';
												   //$avatartempname=$_id.'.jpg';
												   //move_uploaded_file($_file_tmp_name,$_patch);
												   $favatar=$apend;

													 // создаём исходное изображение на основе 
													 // исходного файла и опеределяем его размеры 
													 $src = imagecreatefromjpeg($_file_tmp_name);
													 $w_src = imagesx($src); 
													 $h_src = imagesy($src);


														 // создаём пустую квадратную картинку 
														 // важно именно truecolor!, иначе будем иметь 8-битный результат 
														 $dest = imagecreatetruecolor($w,$w); 

														 // вырезаем квадратную серединку по x, если фото горизонтальное 
														 if ($w_src>$h_src) 
														 imagecopyresampled($dest, $src, 0, 0,
																		  round((max($w_src,$h_src)-min($w_src,$h_src))/2),
																		  0, $w, $w, min($w_src,$h_src), min($w_src,$h_src)); 

														 // вырезаем квадратную верхушку по y, 
														 // если фото вертикальное (хотя можно тоже серединку) 
														 if ($w_src<$h_src) 
														 imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $w,
																		  min($w_src,$h_src), min($w_src,$h_src)); 

														 // квадратная картинка масштабируется без вырезок 
														 if ($w_src==$h_src) 
														 imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $w, $w_src, $w_src);

														 imagejpeg($dest,$_patch,$q);
											}
											
											function well_img_resize($src, $dest, $m_width, $m_height, $rgb=0xFFFFFF, $quality=100) // Сжимание изображения
											{
											  if (!file_exists($src)) return false;

											  $size = getimagesize($src);

											  if ($size === false) return false;

												list($f_width, $f_height, $f_type, $f_attr)=getimagesize($src);
												
												//echo 'm_width: '.$m_width;
												
												if ($f_width>$m_width)
													{
													//echo ' 1done';
													$width=$m_width;
													$height=$f_height/($f_width/$m_width);
													}
													else
													{
													$width=$f_width;
													$height=$f_height;
													}
												
												if ($height>$m_height)
													{
													//echo ' 2done';
													$height=$m_height;
													$width=$f_width/($f_height/$m_height);
													}  
											   
											  //echo 'width: '.$width;
											  //echo 'height: '.$height;
											  
											  // Определяем исходный формат по MIME-информации, предоставленной
											  // функцией getimagesize, и выбираем соответствующую формату
											  // imagecreatefrom-функцию.
											  $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
											  $icfunc = "imagecreatefrom" . $format;
											  if (!function_exists($icfunc)) return false;

											  $x_ratio = $width / $size[0];
											  $y_ratio = $height / $size[1];

											  $ratio       = min($x_ratio, $y_ratio);
											  $use_x_ratio = ($x_ratio == $ratio);

											  $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
											  $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
											  $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
											  $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

											  $isrc = $icfunc($src);
											  $idest = imagecreatetruecolor($width, $height);

											  imagefill($idest, 0, 0, $rgb);
											  imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, 
												$new_width, $new_height, $size[0], $size[1]);

											  imagejpeg($idest, $dest, $quality);

											  imagedestroy($isrc);
											  imagedestroy($idest);

											  return true;
											}

											function well_translitIt($str) 
											{
												$tr = array(
													"А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
													"Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
													"Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
													"О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
													"У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
													"Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
													"Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
													"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
													"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
													"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
													"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
													"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
													"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
													" "=> "_", "."=> "", "/"=> "_","\""=> "","\'"=> "","?"=> ""
												);
												return strtr($str,$tr);
											}											
											
											
if ($_deleteobject) { // Удаляем объект
		$query="DELETE FROM `".$config_well_object[$_object]['table']."` WHERE id=".$_id;
		if (!$object=mysql_query($query)){$error=1;$error_msg='Ошибка: Не удалось обновить данные в базе ('.mysql_error().') <br><br>Запрос:'.$query;}
} else { // Сохраняем объект
											
		if ($_action=='add') { // Добавляем объект
			$query="INSERT INTO `".$config_well_object[$_object]['table']."` (id) VALUES (DEFAULT)";
			if (!$result=mysql_query($query)){$error=1;$error_msg='Ошибка: Не удалось создать строку ('.mysql_error().') <br><br>Запрос:'.$query;}
			$_id=mysql_insert_id();
		}
													
													
		// Вытаскиваем объект и помещаем строку в objects_row
		$query="SELECT * FROM `".$config_well_object[$_object]['table']."` WHERE id=".$_id;
		if (!$object=mysql_query($query)){$error=1;$error_msg='Ошибка: Не удалось обновить данные в базе ('.mysql_error().') <br><br>Запрос:'.$query;}
		$object_row=mysql_fetch_array($object);
		
		// Дополнительные поля, переданные в админку через GET
		// Временно создаем для них место в массиве конфигурации, что бы следующий скрипт принял их за переданные данные формы через POST
		foreach ($_POST as $key=>$value) {
			if (subStr($key,0,6)=='field_') {
				$row=subStr($key,6,strlen($key));
				$config_well_object[$_object]['fields'][$row]['type']='string';
				$_POST['additional_'.$row]=$value;
			}
		}		


		// Дополнительные столбцы таблицы
		// К этому моменту строка в БД уже должна быть создана и загружена в objects_row
		if ($config_well_object[$_object]['fields']) {
			foreach($config_well_object[$_object]['fields'] as $row=>$value) {
				if ($value['use_prefix']==true) {$current_column_prefix=$_column_prefix;} else {$current_column_prefix='';}
				
				if ($value['type']=='string') {
					$query="UPDATE `".$config_well_object[$_object]['table']."` SET `".$current_column_prefix.$row."`='".$_POST['additional_'.$current_column_prefix.$row]."' WHERE id=".$_id;
					if (!$result=mysql_query($query)){$error=1;$error_msg='Ошибка: Не удалось обновить данные в базе ('.mysql_error().') <br><br>Запрос:'.$query;}
				}

				if ($value['type']=='text') {
					$query="UPDATE `".$config_well_object[$_object]['table']."` SET ".$current_column_prefix.$row."='".$_POST['additional_'.$current_column_prefix.$row]."' WHERE id=".$_id;
					if (!$result=mysql_query($query)){$error=1;$error_msg='Ошибка: Не удалось обновить данные в базе ('.mysql_error().') <br><br>Запрос:'.$query;}
				}

				if ($value['type']=='checkbox') {
					$query="UPDATE `".$config_well_object[$_object]['table']."` SET ".$current_column_prefix.$row."='".$_POST['additional_'.$current_column_prefix.$row]."' WHERE id=".$_id;
					if (!$result=mysql_query($query)){$error=1;$error_msg='Ошибка: Не удалось обновить данные в базе ('.mysql_error().') <br><br>Запрос:'.$query;}
				}

				if ($value['type']=='select') {
					$query="UPDATE `".$config_well_object[$_object]['table']."` SET ".$current_column_prefix.$row."='".$value['select_mask1'].$_POST['additional_'.$current_column_prefix.$row].$value['select_mask2']."' WHERE id=".$_id;
					if (!$result=mysql_query($query)){$error=1;$error_msg='Ошибка: Не удалось обновить данные в базе ('.mysql_error().') <br><br>Запрос:'.$query;}
				}
				
				if ($value['type']=='password') {
					$query="UPDATE `".$config_well_object[$_object]['table']."` SET ".$current_column_prefix.$row."='".md5($_POST['additional_'.$current_column_prefix.$row])."' WHERE id=".$_id;
					if (!$result=mysql_query($query)){$error=1;$error_msg='Ошибка: Не удалось обновить данные в базе ('.mysql_error().') <br><br>Запрос:'.$query;}
				}

				if ($value['type']=='newdatetime') {
					$query="UPDATE `".$config_well_object[$_object]['table']."` SET ".$current_column_prefix.$row."='".$_POST['additional_'.$current_column_prefix.$row]."' WHERE id=".$_id;
					if (!$result=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
				}

				if ($value['type']=='translit') {
					$query="SELECT * FROM `".$config_well_object[$_object]['table']."` WHERE id=".$_id;
					if (!$result=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
					$temp=mysql_fetch_array($result);
					$resultvalue=$temp[$value['field']];
					
					$query="UPDATE `".$config_well_object[$_object]['table']."` SET ".$current_column_prefix.$row."='".well_translitIt($resultvalue)."' WHERE id=".$_id;
					if (!$result=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
				}
				
				if ((($value['type']=='image') or ($value['type']=='file')) and ($_FILES['file_'.$current_column_prefix.$row]['name'])) {
					foreach ($value['copies'] as $copykey=>$copyvalue) {
							// ДЕКОДИРОВАНИЕ СТРОКИ ############################
							$arr=str_split ($copyvalue['patch']);
							$res='';
							$status='normal';
							foreach ($arr as $k=>$v) {
								if ($v=='>') { //Начинаем брать поле
									$field='';
									$status='getfield';
									$v='';
								}

								if ($v=='<') { // Заканчиваем брать поле
									$status='normal';
									$res=$res.$object_row[$field];
									$v='';
								}
								
								if ($status=='getfield') { // Берем поле
									$field=$field.$v;
								}


								if ($v=='?') { // Начинаем брать параметр
									$parametr='';
									$status='getparametr';
									$v='';
								}

								if ($v=='*') { // Заканчиваем брать параметр
									$status='normal';
									if ($parametr=='filename') {
										$res=$res.$_FILES['file_'.$current_column_prefix.$row]["name"];
										}
									$v='';
								}
								
								if ($status=='getparametr') { // Берем параметр
									$parametr=$parametr.$v;
								}
								
								if ($status=='normal') { // Обычное перенесение строке
									$res=$res.$v;
								}								
							}
							// ДЕКОДИРОВАНИЕ СТРОКИ ############################
							$patch=$config_document_root.'/'.$res;
							
							unlink($patch);
							mkdir(dirname($patch));
							if (($copyvalue['method']=='none') or (!$copyvalue['method'])){
								copy($_FILES['file_'.$current_column_prefix.$row]["tmp_name"],$patch);
							}
							if ($copyvalue['method']=='normal') {
								well_img_resize($_FILES['file_'.$current_column_prefix.$row]["tmp_name"],$patch, $copyvalue['size'],$copyvalue['size']);
							}
							if ($copyvalue['method']=='square') {
								well_img_resize_square($_FILES['file_'.$current_column_prefix.$row]["tmp_name"],$patch, $copyvalue['size']);
							}
					}
					// Если при этом надо записать что-то в базу
					if (!$value['nodbupdate']) {
						$query="UPDATE `".$config_well_object[$_object]['table']."` SET `".$current_column_prefix.$row."`='".$res."' WHERE id=".$_id;
						if (!$result=mysql_query($query)){$error=1;$error_msg='Ошибка: Не удалось обновить данные в базе ('.mysql_error().') <br><br>Запрос:'.$query;}
					}
				}
			}

			// Дополнительные файлы
			/*
			foreach ($_FILES as $key=>$value) {
				if ((subStr($key,0,15)=='additional_file') and ($value["tmp_name"])) {
					$folder=$config_document_upload."/".$config_well_object[$_object]['table']."/".$id;
					$row=subStr($key,16,strlen($key));

					if(!(is_dir($folder) == true)){
						mkdir($folder, 0777);
						chmod ($folder, 0777);
						}
					move_uploaded_file($value['tmp_name'],$folder."/".$value['name']);

					Debug(subStr($key,16,strlen($key)));
					Debug($config_well_object[$_object]['table']);
					Debug($row);
					$query="UPDATE ".$config_well_object[$_object]['table']." SET ".$row."='".$value['name']."' WHERE id=".$id;
					if (!$result=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
				}
			}
			*/
		}
}

Redirect($_SESSION["url"]);
?>