			<div class="topmenu">
				<div class="structure_paper">
					<?php
						$query="SELECT * FROM menu WHERE visible='on' AND parent=0 AND type=0 ORDER BY sorting";
						if (!$menu=mysql_query($query)){ErrorPage("Ошибка при обращении к базе данных.<br><br>Запрос: ".$query."<br><br>Ошибка: ".mysql_error());}
							
						while ($menu_row=mysql_fetch_array($menu)) {
									if ($menu_select==$menu_row['id']) {
										echo '<div class="menu" id="menu_selected">'.$menu_row['name'].'</div>';						
									} else {
										echo '<a class="menu" href="'.$config_url_root.'/'.$menu_row['url'].'">'.$menu_row['name'].'</a>';
									}
									if ($_SESSION['user_type']==2) {echo well_link('E','well_edit.php?object=menu&action=edit&id='.$menu_row['id']);}
						}
						echo well_link('Добавить раздел','well_edit.php?object=menu&action=add');
					?>
				</div>
			</div>
			
			<div class="z" style="height:30px;"></div>
			
			<div class="structure_paper">
					<div class="structure_paper_margin">
						<br><br>
						<div id="logo">
								<a href="<?php echo $config_url_index;?>">
								<img border=0 src="images/logo.png">
								</a>
						</div><div class="inline">
							<div style="margin-left:40px; width:730px; margin-bottom:1px; text-align:right;"><img src="images/contacts.jpg"></div>
							<div style="margin-left:40px; width:730px;"><img src="images/slogan.jpg"></div>
						</div>
					</div>
			</div>
		

