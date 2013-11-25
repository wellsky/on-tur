<?php
//error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");

include("_start.php");

echo '<base href="'.$config_url_root.'/" />';

$_SESSION['url']=$_SERVER["REQUEST_URI"];

$_url=mysql_real_escape_string($_GET['url']);

$query="SELECT * FROM tours WHERE url='".$_url."'";
if (!$objects=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
$objects_row=mysql_fetch_array($objects);
?>

<!DOCTYPE HTML>
<html>
	<!-- Load jQuery -->
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript">
		google.load("jquery", "1");
	</script>
<head>
	<title><?php echo $objects_row['title'];?></title>
	<meta name="description" content="<?php echo $objects_row['description'];?>">
	<meta name="keywords" content="<?php echo $objects_row['keywords'];?>">
	<link type="text/css" rel="stylesheet" href="style.css">

	<!-- Pretty photo -->
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
	<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
	
	<!-- arcticModal -->
	<script src="js/arcticmodal/jquery.arcticmodal-0.3.min.js"></script>
	<link rel="stylesheet" href="js/arcticmodal/jquery.arcticmodal-0.3.css">

	<!-- arcticModal theme -->
	<link rel="stylesheet" href="js/arcticmodal/themes/simple.css">	

	<!-- CARUSEL -->
	<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/skins/tango/skin.css" />
	
	<!-- NIVO-SLIDER -->
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
	<link rel="stylesheet" href="css/themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	
	<!-- JQUERY UI -->
	<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script><!-- Сдайдер -->

	<!-- Well CMS -->
	<?php if ($_SESSION['user_type']==2) {
	echo '<script src="/mercury/mercury_loader.js" type="text/javascript"></script>';
	echo '<script src="well_func_js.js" type="text/javascript"></script>';
	} 
	?>

	
	<script type="text/javascript" src="java.js"></script>
</head>

<script type="text/javascript" charset="utf-8"> // Функция prettyphoto
			$(document).ready(function(){
				$("area[rel^='prettyPhoto']").prettyPhoto();
				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false, social_tools:false});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
					custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
					changepicturecallback: function(){ initialize(); }
				});

				$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
					custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
					changepicturecallback: function(){ _bsap.exec(); }
				});
			});
</script>

<body><div id="topbackground">
	<div id="structure_all">
		<div id="structure_main">
			<? include('un_header.php');?>
			
			<div class="structure_paper">
				<div class="structure_paper_margin">
					<?php if ($_SESSION['user_type']==2) {echo well_link('Редактировать тур','well_edit.php?object=tour&action=edit&id='.$objects_row['id']);}?>
					<?php if ($_SESSION['user_type']==2) {echo well_link('Добавить изображение','well_edit.php?object=photo&action=add&field_parent='.$objects_row['id']);}?>
					<?php if ($_SESSION['user_type']==2) {echo well_link('Выйти','well_edit.php?action=logout').'<br>';}?>
					<div class="row1">
							<?php include('un_sidebar_left.php');?>
					</div><div class="rowZ"></div><div class="row2">
							<?php 
								echo '<h2 '.well_edit_direct('tours', 'name', $objects_row['id']).'>'.$objects_row['name'].'</h2>';
								$query="SELECT * FROM photos WHERE parent=".$objects_row['id']." ORDER BY sorting";
								if (!$photos=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
								echo '<div class="gallery clearfix">';
										while ($photos_row=mysql_fetch_array($photos)) {
											echo '<div class="inline" style="margin:0 4px 4px 0;">';
											echo '<a rel="prettyPhoto['.$objects_row['id'].']" href="data/photos/'.$photos_row['id'].'/1280.jpg"><img border=0 src="data/photos/'.$photos_row['id'].'/160.jpg"></a>';
											if ($_SESSION['user_type']==2) {echo '<br>'.well_link('Редактировать','well_edit.php?object=photo&action=edit&id='.$photos_row['id']);}
											echo '</div>';
										}
								echo '</div>';
								
								echo '<div '.well_edit_direct('tours', 'text', $objects_row['id']).'>';
								echo $objects_row['text'];
								echo '</div>';
								
								echo '<br><a href="#" value="'.$objects_row['id'].'" class="onlinethis" title="Заказать этот тур сейчас"></a>';
							?>
					</div><div class="rowZ"></div><div class="row3">
							<?php include('un_sidebar_right.php');?>
					</div>
				</div>
			</div>
			
			
		<div id="structure_push"></div>
		</div>
		
		<div id="structure_footer">
				<?php include('un_footer.php'); ?>
		</div>
	</div>
</div></body>
</html>
