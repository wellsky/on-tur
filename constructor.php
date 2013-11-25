<?php
//error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");

include("_start.php");

echo '<base href="'.$config_url_root.'/" />';

$_SESSION['url']=$_SERVER["REQUEST_URI"];

$_url=mysql_real_escape_string($_GET['url']);


$query="SELECT * FROM puzzles ORDER BY sorting";
if (!$puzzles=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
?>

<!DOCTYPE HTML>
<html>
	<!-- Load jQuery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
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
			var likes=Array();
			$(window).load(function() {
				$('.puzzle').draggable({
						revert:'invalid',
						start:function(){$(this).css('z-index','100');},
						stop:function(){$(this).css('z-index','1');}
				});
				
				$('#constructor').droppable({
					snap: true,
					drop: function(e,ui) {
						ui.draggable.css('border', '1px solid #0f0');
						if (likes.indexOf(ui.draggable.attr("value"))==-1) {
								likes.push(ui.draggable.attr("value"));
						}
						
						var text='';
						likes.forEach(function(element,index,array){if(element) {text=text+element+';<br>'}});
						$('#list').html(text);
					}
				});
				
				$('#options').droppable({
					drop: function(e,ui) {
						ui.draggable.css('border', '1px solid #fff');
						likes.splice(likes.indexOf(ui.draggable.attr("value")),1);
						var text='';
						likes.forEach(function(element,index,array){if(element) {text=text+element+';<br>';}});
						$('#list').html(text);
					}
				});
				
			});			
</script>

<body><div id="topbackground">
	<div id="structure_all">
		<div id="structure_main">
			<? include('un_header.php');?>
			
			<div class="structure_paper">
				<div class="structure_paper_margin">
					<?php if ($_SESSION['user_type']==2) {echo well_link('Добавить паззл','well_edit.php?object=puzzle&action=add');}?>
					<?php if ($_SESSION['user_type']==2) {echo well_link('Выйти','well_edit.php?action=logout').'<br>';}?>
					<div class="row1">
							<?php include('un_sidebar_left.php');?>
					</div><div class="rowZ"></div><div class="row2">
							<h2>Собери свой тур!</h2>
							<div id="options">
								<?php
								while($puzzle_row=mysql_fetch_array($puzzles)) {
									echo '
									<div class="inline">
										<img class="puzzle" value="'.$puzzle_row['name'].'" src="data/puzzles/'.$puzzle_row['id'].'/120.jpg"><br>
										'.well_link('Ред. паззл','well_edit.php?object=puzzle&action=edit&id='.$puzzle_row['id']).'
									</div>';
								}
								?>
							</div>
							<br>
							Просто перетащите все что Вам нравится сверху вниз, на Ваш отдых.<br><br>
							<div id="constructor"></div>
							<form action="send">
								<h3>Что мы имеем:</h3>
								<div id="list"></div>
								<h3>Как Вам позвонить:</h3>
								<input type="text" name="phone">
								<br><br><hr>
								Все поля ниже заполнять не обязательно, но они помогут нам более точно подобрать Вам тур.
								<h3>Как Вас зовут:</h3>
								<input type="text" name="name">
								<h3>И какую сумму Вы готовы потраить?</h3>
								<input type="text" name="sum">
								<h3>Любые другие пожелания в свободной форме:</h3>
								<textarea name="text" style="width:100%; height:100px;"></textarea>
								<br>
								<input type="submit" value="Подобрать тур!">
							</form>
							
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
