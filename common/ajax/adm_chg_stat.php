<?
/*
Ryan skymanla
관리자 상태 변경(수정 및 삭제)
 */
header("Content-Type:application/json");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
session_start();
$ad_name = $_REQUEST['chg_name'];
$ad_pw = $_REQUEST['chg_pw'];
$mode = $_REQUEST['mode'];
$seq = $_REQUEST['seq'];

$mod_arr = array("D", "U");

if(!in_array($mode, $mod_arr)){
	$r = array("msg"=>"잘못된 접근입니다.");
	$r = (object) $r;
	echo json_encode($r);
	exit;
}
//검증
$sql = "select * from tbl_admin where ad_seq='".$seq."'";
$q = $db->query($sql);
if($q->rowCount() == false){
	$r = array("msg"=>"존재하지 않는 관리자입니다.");
	$r = (object) $r;
	echo json_encode($r);
	exit;
}

//변경
if(trim($ad_pw) != ""){//pw 미변경
	$hash = password_hash($ad_pw, PASSWORD_BCRYPT);
	$pw_common = ", ad_pwd='".$hash."'";
}else{
	$pw_common = '';
}

if($mode == "D"){
	$chg_common = " ad_del_flag='1', ad_del_time=now(), ad_del_id='".$_SESSION['id']."', ad_del_ip='".$_SERVER['REMOTE_ADDR']."' ";
}else if($mode == "U"){
	$chg_common = " ad_name='".$ad_name."', ad_modi_date=now() ".$pw_common;
}
$sql = " update tbl_admin set ".$chg_common." where ad_seq='".$seq."'";

/*$msg_arr = array("msg"=>$sql);
$msg_arr = (object) $msg_arr;
echo json_encode($msg_arr);
exit;*/
if($db->query($sql)){
	$r = array("msg"=>"회원정보가 변경되었습니다.");
	$r = (object) $r;
	echo json_encode($r);
	exit;
}else{
	$r = array("msg"=>"SQL Error");
	$r = (object) $r;
	echo json_encode($r);
	exit;
}
?>