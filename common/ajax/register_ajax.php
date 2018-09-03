<?php
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
header("Content-Type:application/json");

$m_id = $_REQUEST['regist_id'];
//$r = array("ID"=>$m_id);
//check id
$sql = "SELECT COUNT(*) as cnt FROM tbl_member where m_id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$m_id]);
$arr = $stmt->fetch();
if($arr['cnt'] > '0'){
	$r = (object) array("msg"=>"이미 가입된 아이디입니다.\n다른 아이디를 사용해주세요.", "code"=>false);
}else{
	$r = (object) array("msg"=>"", "code"=>true);
}

echo json_encode($r);
exit;
?>