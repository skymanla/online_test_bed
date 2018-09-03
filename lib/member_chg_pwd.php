<?php
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");

session_start();

$now_pwd = $_POST['now_pw'];
$new_pwd = $_POST['new_pw'];

$getId = $_SESSION['email'];
$sql = "select m_pwd from tbl_member where m_id=?";
$query = $db->prepare($sql);

try{
	$query->execute([$getId]);
}catch(Exception $e){

}

$member_data = $query->fetch();

if(password_verify($now_pwd, $member_data['m_pwd'])){
	$new_pwd = password_hash($new_pwd, PASSWORD_BCRYPT);
	$sql = "update tbl_member set m_pwd=? where m_id='".$getId."'";
	$query = $db->prepare($sql);
	$query->execute([$new_pwd]);

	session_destroy();
	unset($_SESSION);
	go_href("비밀번호가 변경되었습니다.\\n재로그인 해주시기 바랍니다.", "/page/member/login.php", "go");
}else{
	go_href("입력하신 현재 비밀번호가 다릅니다.", "/page/s6/s2.php", "go");
}
?>