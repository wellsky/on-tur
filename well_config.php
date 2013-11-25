<?php
$config_well_object['menu'] = Array (
	'name'=>'Меню',
	'table'=>'menu',
	'allowdelete'=>true,
	
	'fields'=> Array (
			'name'=>Array(
					'title'=>'Название',
					'type'=>'string',
					),
			'url'=>Array(
					'title'=>'Адрес страницы',
					'type'=>'string',
					),
			'sorting'=>Array(
					'title'=>'Порядковый номер',
					'type'=>'string',
					),
			'visible'=>Array(
					'title'=>'Отображать в меню',
					'type'=>'checkbox',
					'default'=>'',
					),					
	)
);

$config_well_object['content'] = Array (
	'name'=>'Содержание',
	'table'=>'menu',
	'width'=>800,
	'allowdelete'=>true,
	
	'fields'=> Array (
			'name'=>Array(
					'title'=>'Название пунка меню',
					'type'=>'string',
					),
			'url'=>Array(
					'title'=>'URL-адрес страницы',
					'type'=>'string',
					),
			'sorting'=>Array(
					'title'=>'Порядковый номер в меню',
					'type'=>'string',
					),
			'title'=>Array(
					'title'=>'Заголовок окна',
					'type'=>'string',
					),
			'description'=>Array(
					'title'=>'Описание для SEO',
					'type'=>'string',
					),
			'keywords'=>Array(
					'title'=>'Ключевые слова для SEO',
					'type'=>'string',
					),
			'header'=>Array(
					'title'=>'Название раздела',
					'type'=>'string',
					),
			'text'=>Array(
					'title'=>'Текст',
					'type'=>'text',
					'wysiwyg'=>true,
					),
			'visible'=>Array(
					'title'=>'Отображать в меню',
					'type'=>'checkbox',
					'default'=>'',
					),						
	)
);


$config_well_object['slider'] = Array (
	'name'=>'Содержание',
	'table'=>'sliders',
	'width'=>800,
	'allowdelete'=>true,
	
	'fields'=> Array (
			'name'=>Array(
					'title'=>'Название слайда',
					'type'=>'string',
					),
			'sorting'=>Array(
					'title'=>'Порядковый номер',
					'type'=>'string',
					),
			'link'=>Array(
					'title'=>'Ссылка',
					'type'=>'string',
					),
			'text'=>Array(
					'title'=>'Содержание',
					'type'=>'string',
					),
			'visible'=>Array(
					'title'=>'Отображать',
					'type'=>'checkbox',
					'default'=>'',
					),
			'image'=>Array(
					'title'=>'Изображение (990 на 350 пикселей)',
					'type'=>'image',
					'nodbupdate'=>true,
					'copies'=>Array(
								Array(
									'patch'=>'data/slider/>id<-990.jpg',
									'method'=>'normal',
									'size'=>990,
								),
							),
					),						
	)
);


$config_well_object['opinions'] = Array (
	'name'=>'Отзыв',
	'table'=>'menu',
	'width'=>800,
	'allowdelete'=>true,
	
	'fields'=> Array (
			'name'=>Array(
					'title'=>'Кто оставил отзыв',
					'type'=>'string',
					),
			'sorting'=>Array(
					'title'=>'Порядковый номер в меню',
					'type'=>'string',
					),
			'description'=>Array(
					'title'=>'Компания',
					'type'=>'string',
					),
			'text'=>Array(
					'title'=>'Отзыв',
					'type'=>'text',
					'wysiwyg'=>true,
					),
			'visible'=>Array(
					'title'=>'Отображать',
					'type'=>'checkbox',
					'default'=>'',
					),						
	)
);


$config_well_object['news'] = Array (
	'name'=>'Новость',
	'table'=>'news',
	'allowdelete'=>true,
	'width'=>800,
	
	'fields'=> Array (
			'name'=>Array(
					'title'=>'Заголовок',
					'type'=>'string',
					'default'=>'',
					),
			'text'=>Array(
					'title'=>'Текст',
					'type'=>'text',
					'default'=>'',
					'wysiwyg'=>true,
					),
			'time'=>Array(
					'type'=>'newdatetime',
					'title'=>'Дата и время',
					'hide'=>false,
					),
			'url'=>Array(
					'title'=>'Адрес страницы (обязательно!)',
					'type'=>'translit',
					'field'=>'name',
					),
			'afisha'=>Array(
					'title'=>'Отображать в правой части',
					'type'=>'checkbox',
					'default'=>'',
					),					
			'video'=>Array(
					'title'=>'Видео с youtube (не обязательно), пример: W8egICazS1E',
					'type'=>'string',
					'default'=>'',
					),
					
			'image'=>Array(
					'title'=>'Изображение',
					'type'=>'image',
					'nodbupdate'=>true,
					'copies'=>Array(
								Array(
									'patch'=>'data/news/>id<-180.jpg',
									'method'=>'normal',
									'size'=>180,
								),
								Array(
									'patch'=>'data/news/>id<-240.jpg',
									'method'=>'normal',
									'size'=>240,
								),
								Array(
									'patch'=>'data/news/>id<-320.jpg',
									'method'=>'normal',
									'size'=>320,
								),								
								Array(
									'patch'=>'data/news/>id<-1280.jpg',
									'method'=>'normal',
									'size'=>1280,
								),	
							),
					),					
	)
);


$config_well_object['puzzle'] = Array (
	'name'=>'Элемент для конструктора туров',
	'table'=>'puzzles',
	'allowdelete'=>true,
	'width'=>800,
	
	'fields'=> Array (
			'name'=>Array(
					'title'=>'Описание',
					'type'=>'string',
					'default'=>'',
					),
			'sorting'=>Array(
					'title'=>'Порядковый номер',
					'type'=>'string',
					'default'=>'',
					),
			'image'=>Array(
					'title'=>'Изображение',
					'type'=>'image',
					'nodbupdate'=>true,
					'copies'=>Array(
								Array(
									'patch'=>'data/puzzles/>id</120.jpg',
									'method'=>'square',
									'size'=>120,
								),
							
								Array(
									'patch'=>'data/puzzles/>id</1280.jpg',
									'method'=>'normal',
									'size'=>1280,
								),	
							),
					),					
	)
);



$config_well_object['tour'] = Array (
	'name'=>'Тур',
	'table'=>'tours',
	'allowdelete'=>true,
	'width'=>800,
	
	'fields'=> Array (
			'name'=>Array(
					'title'=>'Заголовок',
					'type'=>'string',
					'default'=>'',
					),
			'category'=>Array(
					'title'=>'Категория',
					'type'=>'select',
					'select_table'=>'categories',
					'select_mask1'=>'', // Что написано в поле parent перед id (опционально)
					'select_mask2'=>'', // Что написано в поле parent после id (опционально)
					'select_name'=>'name',
					),					

			'text'=>Array(
					'title'=>'Текст',
					'type'=>'text',
					'default'=>'',
					'wysiwyg'=>true,
					),
			'time'=>Array(
					'type'=>'newdatetime',
					'title'=>'Дата и время',
					'hide'=>false,
					),
			'url'=>Array(
					'title'=>'Адрес страницы (обязательно!)',
					'type'=>'translit',
					'field'=>'name',
					),
			'afisha'=>Array(
					'title'=>'Отображать в правой части',
					'type'=>'checkbox',
					'default'=>'',
					),					
			'price'=>Array(
					'title'=>'Цена тура, руб.',
					'type'=>'string',
					'default'=>'',
					),
			'image'=>Array(
					'title'=>'Изображение',
					'type'=>'image',
					'nodbupdate'=>true,
					'copies'=>Array(
								Array(
									'patch'=>'data/news/>id<-160.jpg',
									'method'=>'normal',
									'size'=>160,
								),
								Array(
									'patch'=>'data/news/>id<-240.jpg',
									'method'=>'normal',
									'size'=>240,
								),
								Array(
									'patch'=>'data/news/>id<-320.jpg',
									'method'=>'normal',
									'size'=>320,
								),								
								Array(
									'patch'=>'data/news/>id<-1280.jpg',
									'method'=>'normal',
									'size'=>1280,
								),	
							),
					),					
	)
);



$config_well_object['photo'] = Array (
	'name'=>'Фотография',
	'table'=>'photos',
	'width'=>800,
	'allowdelete'=>true,
	
	'fields'=> Array (
			'sorting'=>Array(
					'title'=>'Порядковый номер в группе',
					'type'=>'string',
					),
			'image'=>Array(
					'title'=>'Изображение',
					'type'=>'image',
					'nodbupdate'=>true,
					'copies'=>Array(
								Array(
									'patch'=>'data/photos/>id</160.jpg',
									'method'=>'square',
									'size'=>160,
								),
								Array(
									'patch'=>'data/photos/>id</60.jpg',
									'method'=>'square',
									'size'=>60,
								),
								Array(
									'patch'=>'data/photos/>id</1280.jpg',
									'method'=>'normal',
									'size'=>1280,
								),
							),
					),					
	)
);


$config_well_object['categories'] = Array (
	'name'=>'Категория туров',
	'table'=>'categories',
	'allowdelete'=>true,
	
	'fields'=> Array (
			'name'=>Array(
					'title'=>'Название',
					'type'=>'string',
					),
			'url'=>Array(
					'type'=>'translit',
					'field'=>'name',
					),
			'sorting'=>Array(
					'title'=>'Порядковый номер',
					'type'=>'string',
					),
			'visible'=>Array(
					'title'=>'Отображать на главной странице',
					'type'=>'checkbox',
					'default'=>'',
					),
			'image'=>Array(
					'title'=>'Изображение для главной страницы',
					'type'=>'image',
					'nodbupdate'=>true,
					'copies'=>Array(
								Array(
									'patch'=>'data/categories/>id</300.jpg',
									'method'=>'normal',
									'size'=>300,
								),
							),
					),						
	)
);
?>