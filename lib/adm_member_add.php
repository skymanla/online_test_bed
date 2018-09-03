<?php
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");

//아이디 중복체크 한번 더
$ad_name = htmlCheck($_POST['ad_name'], "N");
$ad_id = htmlCheck($_POST['ad_id'], "N");
$ad_pwd = $_POST['ad_pwd'];

$sql = "select count(*) as cnt from tbl_admin where ad_id=?";
$query = $db->prepare($sql);
$query->execute([$ad_id]);
$data = $query->fetch();

if($data['cnt'] > 0){
	header("HTTP/1.1 400 Bad Request");
	go_href("중복된 아이디입니다.", "/adm/page/s2/s1.php", "go");
	exit;
}

$sql = "insert into tbl_admin set ad_id=:ad_id, ad_name=:ad_name, ad_pwd=:ad_pwdm ad_regdate=now() ";
$query = $db->prepare($sql);
try{
	$query->execute(array("ad_id"=>$ad_id,
						"ad_name"=>$ad_name,
						"ad_pwd"=>password_hash($ad_pwd, PASSWORD_BCRYPT)
					));
}catch(PDOException $e){
	print $e->getMessage();
}

go_href("사용자가 추가되었습니다.", "/adm/page/s2/s1.php", "go");
exit;

?>