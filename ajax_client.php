<?
include("_start.php");

$_id=mysql_real_escape_string($_GET['id']);
$_id=substr($_id,6,strlen($_id));

	$query="SELECT * FROM menu WHERE type=1 AND id=".$_id;
	if (!$portfolio=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
	$portfolio_row=mysql_fetch_array($portfolio);
	
	echo '<div class="content_margin" style="padding-top:1px;">';
		echo '<h2>'.$portfolio_row['header'].'</h2>';
		echo '<img style="border:0; margin:0 40 0 0; cursor:pointer; float:left;" src="data/portfolio/'.$portfolio_row['id'].'-238.jpg">';
		echo $portfolio_row['text'];
	echo '</div>';

?>