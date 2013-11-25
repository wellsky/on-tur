<?php
//error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");

include("_start.php");

echo '<base href="'.$config_url_root.'/" />';

$_SESSION['url']=$_SERVER["REQUEST_URI"];

$_url=mysql_real_escape_string($_GET['url']);

$query="SELECT * FROM menu WHERE url='".$_url."'";
if (!$objects=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
$objects_row=mysql_fetch_array($objects);
$menu_select=$objects_row['id'];

$query="SELECT * FROM news ORDER BY time";
if (!$news=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
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

<body><div id="topbackground">
	<div id="structure_all">
		<div id="structure_main">
			<? include('un_header.php');?>
			
			<div class="structure_paper">
				<div class="structure_paper_margin">
					<?php if ($_SESSION['user_type']==2) {echo well_link('Добавить новость','well_edit.php?object=news&action=add');}?>
					<?php if ($_SESSION['user_type']==2) {echo well_link('Выйти','well_edit.php?action=logout').'<br>';}?>
					<div class="row1">
							<?php include('un_sidebar_left.php');?>
					</div><div class="rowZ"></div><div class="row2">
							<h2 <? echo well_edit_direct('menu', 'header', $objects_row['id']);?>><?php echo $objects_row['header'];?></h2>
							<?php 
								echo '<div '.well_edit_direct('menu', 'text', $objects_row['id']).'>'.$objects_row['text'].'</div>';
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
