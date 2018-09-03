<?php
/*
Ryan skymanla
admin login
 */
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
session_start();
$ad_id = $_POST['id'];
$ad_pw = $_POST['pw'];

$sql = "select * from tbl_admin where ad_id = ? and ad_del_flag is null";
$query = $db->prepare($sql);
try{
	$query->execute([$ad_id]);
}catch(PDOException $e){
	echo $e->getMessage();
}


$admin_fetch = $query->fetch();

if(empty($admin_fetch)){
	go_href("접속 정보가 올바르지 않습니다.", "/", "go");
	exit;
}
if(password_verify($ad_pw, $admin_fetch['ad_pwd'])){	
	$_SESSION['id'] = $admin_fetch['ad_id'];
	$_SESSION['name'] = $admin_fetch['ad_name'];
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	$_SESSION['auth_flag'] = "admin";

	$sql = "update tbl_admin set ad_logdate=now(), ad_logip='".$_SERVER['REMOTE_ADDR']."' where ad_id='$ad_id'";
	$db->query($sql);
	go_href("관리자로 로그인하였습니다.", "/adm/page/s1/s1.php", "go");
	exit;
}else{
	go_href("접속 정보가 올바르지 않습니다.", "/", "go");
	exit;
}
?>