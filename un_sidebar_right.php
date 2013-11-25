							<h2>СТРАНОВЕДЕНИЕ</h2>
							По разным оценкам, в 2012 году россияне приобрели за рубежом недвижимость на общую сумму более 12 млрд. долларов. Особенно активно наши соотечественники ведут себя на европейском рынке. В частности, за последние годы граждане России.
							<br><br><br>
							<h2>РАЗНЫЙ ОТДЫХ</h2>
							<?
							$query="SELECT * FROM categories";
							if (!$categories=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
							
							echo '<div style="margin-left:10px;">';
							while ($categories_row=mysql_fetch_array($categories)) {
								echo '<a href="tours/'.$categories_row['url'].'">'.$categories_row['name'].'</a>'.well_link('Ред.','well_edit.php?object=categories&action=edit&id='.$categories_row['id']).'<div class="z" style="height:6px;"></div>';
							}
							echo '</div>';
							
							echo well_link('Добавить категорию','well_edit.php?object=categories&action=add');
							?>
							<br><br><br>
							<h2>НАШИ ДРУЗЬЯ</h2>
							<img src="images/friends.jpg">
							<br><br><br>