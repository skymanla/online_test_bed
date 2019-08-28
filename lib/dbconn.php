<?php
try{
	$db = new PDO("mysql:host=localhost;dbname=localhost", "id", "pwd");
}catch(PDOException $e){
	echo 'Connect failed : '.$e->getMessage().'';
	return false;
}
//include_once('./common.php');
define("__HOST__", "http://".$_SERVER['HTTP_HOST']);
define("dir", $_SERVER['DOCUMENT_ROOT']);
?>
