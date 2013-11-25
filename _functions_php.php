<?php
function Debug($s) {
if (($_SESSION['debug']) and ($_SESSION['user_type']==2)) {
	echo '<span style="color:#fff000; background-color:#000;">Debug message: </span><span style="color:#39c91d; background-color:#000;">'.$s.'&nbsp</span><br>';
	}
}

function DebugError($s) {
if (($_SESSION['debug']) and ($_SESSION['user_type']==2)) {
	echo '<span style="color:#fff000; background-color:#000;">Debug message: </span><span style="color:#e21b1b; background-color:#000;">'.$s.'&nbsp</span> <br>';
	}
}

function Redirect($url) {
	if (($_SESSION['debug']) and ($_SESSION['user_type']==2)) {
		echo '<span style="color:#fff000; background-color:#000;">Был вызван Redirect </span><a style="color:#41a1e4; background-color:#000;" href="'.$url.'">перейти по ссылке</a>';
	} else {
		echo "<html><head><meta http-equiv='Refresh' content='0; URL=".$url."'></head></html>";
	}
}

function WriteLog($_action, $_user, $_parent, $_id) {
$query="INSERT INTO logs (time, event_user, event_action, event_parent, event_id) VALUES (NOW(), '".$_user."', '".$_action."', '".$_parent."', '".$_id."')";
if (!$result=mysql_query($query)){ErrorPage("Ошибка базы данных при записи лога:<br>".$query."<br>".mysql_error());}
}


function ErrorPage($msg) // Переход на страницу с ошибкой
{
$_SESSION["error_message"]=$msg;
global $config_url_root;
echo "<html><head><meta http-equiv='Refresh' content='0; URL=".$config_url_root."/error.php'></head></html>";
exit;
}


function utf8_compliant($str) {
    if ( strlen($str) == 0 ) return true;
    return (preg_match('/^.{1}/us',$str) == 1);
}


function removeDirectory($dir) {
    if ($objs = glob($dir."/*")) {
       foreach($objs as $obj) {
         is_dir($obj) ? removeDirectory($obj) : unlink($obj);
       }
    }
    rmdir($dir);
  }

function cutString($string, $maxchar=64) { // Обрезание строки по словам
$result_string=$string;
	if (strlen ($string) > $maxchar)
		{
		$result_string = substr ($string, 0, $maxchar-strlen (strrchr (substr ($string, 0, $maxchar), ' ')));
		$result_string = $result_string.'...';
		}
return $result_string;
}

function generate_code($length = 7){ // Генерация случайной строки
		$num = rand(11111, 99999);
		$code = md5($num);
		$code = substr($code, 0, (int)$length);
		return $code;
		}	

function img_resize($src, $dest, $m_width, $m_height, $rgb=0xFFFFFF, $quality=100) // Сжимание изображения
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

function stringNumber($num, $text1='штука', $text2='штуки', $text3='штук')	{ // Склоняет слово в соответствии с его числовым значением
	$num=$num%100;
	$w_ost=$num % 10;
	$w_exeptions = array(2,3,4);
	$w_str="?";

	if (($num>10) and ($num<20)) {
		$w_str=$text3;
		} else {
			if ($w_ost==1) {
				$w_str=$text1;
				} elseif (in_array($w_ost, $w_exeptions)) {
				$w_str=$text2;
				} else {
				$w_str=$text3;
				}
		}
	return $w_str;
}

function stars($rating) {
echo '
<div class="stars">
	<div class="greenstars" style="width:'.(($rating/10)*20).'px;">
	<img src="images/stars.png">
	</div>
</div>
';
}

function getExtension($filename) {
   return strtolower(end(explode(".", $filename)));
}
?>