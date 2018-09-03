<?php
header("Content-Type:application/json");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");


$ad_id = htmlCheck($_REQUEST['ad_id'], "N");

$sql = "select count(*) as cnt from tbl_admin where ad_id = ?";
$query = $db->prepare($sql);
$query->execute([$ad_id]);


$chk = $query->fetch();

if($chk['cnt'] > 0){
	$r = array("msg"=>"이미 등록된 아이디입니다", "code"=>"");
	$r = (object) $r;
	echo json_encode($r);
	exit;
}else{
	$r = array("msg"=>"사용가능한 아이디입니다.", "code"=>"readonly");
	$r = (object) $r;
	echo json_encode($r);
	exit;
}
?>