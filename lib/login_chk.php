<?php
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
session_start();
$id = $_POST['email'];
$pw = $_POST['pw'];
$ip = $_SERVER['REMOTE_ADDR'];
//회원 가입 유무
$sql = "select count(*) as cnt from tbl_member where m_id=? and m_del_flag is null";
$query = $db->prepare($sql);
try{
	$query->execute([$id]);
}catch(PDOException $e){
	echo "erorr";
}
$member_cnt = $query->fetch();
if($member_cnt['cnt'] == '0'){
	go_href("가입되지 않은 이메일입니다.\\n회원가입을 해주시기 바랍니다.", "/", "go");
	exit;
}

$sql = "select * from tbl_member where m_id = :id ";
$query = $db->prepare($sql);
try{
	$query->execute(array("id"=>$id));
}catch(PDOException $e){
	echo 'erererer';
}
$member_info = $query->fetch();

if(password_verify($pw, $member_info['m_pwd'])){
	if(empty($member_info['m_auth'])){
		session_destroy();
		go_href("회원 승인 대기 중입니다.\\n관리자에게 문의주시기 바랍니다.", "/", "go");
		exit;	
	}else if($member_info['m_auth'] == "N"){
		session_destroy();
		go_href("승인이 거절되었습니다.\\n관리자에게 문의주시기 바랍니다.", "/", "go");
		exit;
	}else if($member_info['m_auth'] == "Y"){
		$_SESSION['email'] = $member_info['m_id'];
		$_SESSION['name'] = $member_info['m_name'];
		$_SESSION['phone'] = $member_info['m_phone'];
		$_SESSION['nick'] = $member_info['m_nick'];
		$_SESSION['logip'] = $ip;
		//정보 추가
		$sql = "update tbl_member set m_logdate=now(), m_visit=m_visit+1, m_logip='$ip' where m_id='$id'";
		$db->query($sql);
		go_href("반갑습니다.\\n".$member_info['m_nick']."님", "/", "go");
	}
}else{
	go_href("패스워드가 틀렸습니다.\\n다시 확인해보시기 바랍니다.", "/page/member/login.php", "go");
	exit;
}
?>