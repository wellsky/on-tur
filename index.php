<?php
//error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");

include("_start.php");

echo '<base href="'.$config_url_root.'/" />';

$_SESSION['url']=$_SERVER["REQUEST_URI"];
$menu_select=8985;

$query="SELECT * FROM menu WHERE url=''";
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
				<?
				$query="SELECT * FROM sliders ORDER BY sorting";
				if (!$slider=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}

				if ($_SESSION['user_type']==2) {
					echo well_link('Добавить слайд','well_edit.php?object=slider&action=add');
					while ($slider_row=mysql_fetch_array($slider)) {	
						echo well_link($slider_row['name'],'well_edit.php?object=slider&action=edit&id='.$slider_row['id']).' ';
					}
				}				
				
				$query="SELECT * FROM sliders WHERE visible='on' ORDER BY sorting";
				if (!$slider=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
				?>
				
				<div class="slider-wrapper theme-default">
					<div id="slider" class="nivoSlider">
						<?php
						while ($slider_row=mysql_fetch_array($slider)) {	
							echo '<a href="'.$slider_row['link'].'"><img border=0 src="data/slider/'.$slider_row['id'].'-990.jpg" alt="'.$slider_row['name'].'" title="'.$slider_row['text'].'"/></a>';
						}
						?>
					</div>
				</div>				
			</div>			
			
			<div class="structure_paper">
				<div class="structure_paper_margin">
					<?php if ($_SESSION['user_type']==2) {echo well_link('Редактировать страницу','well_edit.php?object=content&action=edit&id='.$objects_row['id']);}?>
					<?php if ($_SESSION['user_type']==2) {echo well_link('Выйти','well_edit.php?action=logout').'<br>';}?>
					<div class="row1">
							<?php include('un_sidebar_left.php');?>
					</div><div class="rowZ"></div><div class="row2">
							<center><h2>ВЫБЕРИТЕ СВОЙ ОТДЫХ</h2></center>
							
							<?php
							$query="SELECT * FROM categories WHERE visible='on'";
							if (!$showcase=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
							
							while ($showcase_row=mysql_fetch_array($showcase)) {
								
								echo '<div class="showcase" style="background-image:Url(\'data/categories/'.$showcase_row['id'].'/300.jpg\');">
										<a href="tours/'.$showcase_row['url'].'"></a>
										<div class="showcase-bottom" style="">'.$showcase_row['name'].'</div>
									  </div>';
							}
							
							?>
							<div class="z" style="height:20px;"></div>
							<div <?php echo well_edit_direct('menu', 'text', $objects_row['id']);?>>
							<?php echo $objects_row['text']?>
							</div>
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
