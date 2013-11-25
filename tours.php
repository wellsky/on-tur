<?php
//error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");

include("_start.php");

echo '<base href="'.$config_url_root.'/" />';

$_category=mysql_real_escape_string($_GET['category']);

$_SESSION['url']=$_SERVER["REQUEST_URI"];

if ($_category) {
	$query="SELECT * FROM categories WHERE url='".$_category."'";
	if (!$categories=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
	$category_row=mysql_fetch_array($categories);
	$_category_id=$category_row['id'];
	
	$query="SELECT t.*, p.id AS image_id FROM tours t LEFT JOIN photos p ON p.parent=t.id WHERE t.category=".$_category_id." GROUP BY t.id ORDER BY time";
} else {
	$query="SELECT t.*, p.id AS image_id FROM tours t LEFT JOIN photos p ON p.parent=t.id GROUP BY t.id ORDER BY time";
}

if (!$tours=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
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
					<?php if ($_SESSION['user_type']==2) {echo well_link('Добавить тур','well_edit.php?object=tour&action=add');}?>
					<?php if ($_SESSION['user_type']==2) {echo well_link('Выйти','well_edit.php?action=logout').'<br>';}?>
					<div class="row1">
							<?php include('un_sidebar_left.php');?>
					</div><div class="rowZ"></div><div class="row2">
							<h2>ТУРЫ</h2>
							
							
							<?php 
							while($tour_row=mysql_fetch_array($tours)) {
								echo '<h2 '.well_edit_direct('tours', 'name', $tour_row['id']).'>'.$tour_row['name'].'</h2>';
								if (file_exists($config_document_root.'/data/photos/'.$tour_row['image_id'].'/160.jpg')) {
									echo '<div class="inline" style="margin:0 20px 20px 0;">
										<a href="tours/view/'.$tour_row['url'].'"><img border=0 src="data/photos/'.$tour_row['image_id'].'/160.jpg"></a>
										<div class="tourprice">от '.$tour_row['price'].' руб.</div>
									</div>';
								}
								echo '<div class="inline" style="width:315px;">';
								echo cutstring(strip_tags($tour_row['text']),512);
								echo '<div class="z" style="height:4px;"></div>';
								echo '<a href="tours/view/'.$tour_row['url'].'">Подробнее...</a>';
								echo '<div class="z" style="height:4px;"></div>';
								if ($_SESSION['user_type']==2) {echo well_link('Редактировать тур','well_edit.php?object=tour&action=edit&id='.$tour_row['id']);}
								echo '</div>';
								
								echo '<div class="z" style="height:40px;"></div>';
								
							}
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
