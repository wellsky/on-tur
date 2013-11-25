<?
// Слайдер ************************************************************************
$query="SELECT * FROM menu WHERE type=2 ORDER BY sorting";
if (!$slider=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}

if ($_SESSION['user_type']==2) {
	$html_slider.=well_link('Добавить слайд','well_edit.php?object=slider&action=add');
	while ($slider_row=mysql_fetch_array($slider)) {	
		$html_slider.='<br>'.well_link($slider_row['name'],'well_edit.php?object=slider&action=edit&id='.$slider_row['id']);
	}
}

// Достаем портфолио сайтов
$query="SELECT * FROM menu WHERE type=2 AND visible='on' ORDER BY sorting";
if (!$slider=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}

$html_slider.='
	<div id="sm_slider" style="display:none;">
		<ul>';
			while ($slider_row=mysql_fetch_array($slider)) {	
				$html_slider.='<li>'.$slider_row['text'].'</li>';
			}
$html_slider.=
		'</ul>
	</div>
';



// Карусель ************************************************************************
	$query="SELECT * FROM menu WHERE type=1 ORDER BY sorting";
	if (!$portfolio=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
	
	$html_carusel.='<ul id="mycarousel" class="jcarousel-skin-tango" style="display:none;">';
	while ($portfolio_row=mysql_fetch_array($portfolio)) {
		$html_carusel.='<li><img class="clients_show" id="client'.$portfolio_row['id'].'" style="border:0; margin:0 0 0 0; cursor:pointer;" src="data/portfolio/'.$portfolio_row['id'].'-238.jpg">';
		if ($_SESSION['user_type']==2) {$html_carusel.='<div style="margin-top:-22px;">'.well_link('Редактировать','well_edit.php?object=portfolio&action=edit&id='.$portfolio_row['id']).'</div>';}
		echo '</li>';
	}
	$html_carusel.='</ul>';
	if ($_SESSION['user_type']==2) {$html_carusel.=well_link('Добавить портфолио','well_edit.php?object=portfolio&action=add&field_type=1');}


// Отзывы ************************************************************************
	$query="SELECT * FROM menu WHERE type=3 ORDER BY sorting";
	if (!$opinions=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}

	while ($opinions_row=mysql_fetch_array($opinions)) {
		$html_opinions.='<span style="color:#F00; font-weight:bolder;">«</span>'.$opinions_row['text'].'<span style="color:#F00; font-weight:bolder;">»</span><br><br>';
		$html_opinions.='<div style="width:100%; text-align:right; font-weight:bolder; color#111;">'.$opinions_row['name'].'</div>';
		$html_opinions.='<div style="width:100%; text-align:right; font-weight:bolder; color#111;">'.$opinions_row['description'].'</div>';
		if ($_SESSION['user_type']==2) {$html_opinions.=well_link('Редактировать отзыв','well_edit.php?object=opinions&action=edit&id='.$opinions_row['id']).'<br><br>';}
	}
	if ($_SESSION['user_type']==2) {$html_opinions.='<br>'.well_link('Добавить отзыв','well_edit.php?object=opinions&action=add&field_type=3').'<br>';}
	
// Отзывы короткие ************************************************************************
	$query="SELECT * FROM menu WHERE type=3 ORDER BY sorting";
	if (!$opinions1=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}

	while ($opinions1_row=mysql_fetch_array($opinions1)) {
		$html_opinions1.='<div class="inline" style="width:380px; margin-right:20px;">';
		$html_opinions1.='<span style="color:#F00; font-weight:bolder;">«</span>'.$opinions1_row['text'].'<span style="color:#F00; font-weight:bolder;">»</span><br><br>';
		$html_opinions1.='<div style="width:100%; text-align:right; font-weight:bolder; color#111;">'.$opinions1_row['name'].'</div>';
		$html_opinions1.='<div style="width:100%; text-align:right; font-weight:bolder; color#111;">'.$opinions1_row['description'].'</div>';
		if ($_SESSION['user_type']==2) {$html_opinions1.=well_link('Редактировать отзыв','well_edit.php?object=opinions&action=edit&id='.$opinions1_row['id']);}
		$html_opinions1.='</div>';
	}
	if ($_SESSION['user_type']==2) {$html_opinions1.='<br>'.well_link('Добавить отзыв','well_edit.php?object=opinions&action=add&field_type=3');}

// Разрыв страницы ************************************************************************
	$html_vspace='
	</div></div><div class="part_bottom"></div>
			<div style="background-color:#aaa; padding:20px 0 20px 0;">
			</div>
	<div class="part_top"></div><div class="paper"><div class="content_margin">';

	
	$html_vspace2='<img style="margin-left:-90px;" src="images/vspace2.jpg">';

// Разрыв страницы в верстке
	$html_hide='
	</div></div><div class="part_bottom"></div>
			<div style="background-color:#aaa; padding:20px 0 20px 0;">
				<div id="clients"></div>
			</div>
	<div class="part_top"></div><div class="paper"><div class="content_margin">';
	
	
$objects_row['text']=str_replace('[slider]',$html_slider, $objects_row['text']);
$objects_row['text']=str_replace('[carusel]',$html_carusel, $objects_row['text']);
$objects_row['text']=str_replace('[opinions]',$html_opinions, $objects_row['text']);
$objects_row['text']=str_replace('[opinions1]',$html_opinions1, $objects_row['text']);
$objects_row['text']=str_replace('[space]',$html_vspace, $objects_row['text']);
$objects_row['text']=str_replace('[space2]',$html_vspace2, $objects_row['text']);
$objects_row['text']=str_replace('[hide]',$html_hide, $objects_row['text']);

?>