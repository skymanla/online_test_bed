<?php
/* Ryan skymanla */
/* Modify member data*/
include_once($_SERVER['DOCUMENT_ROOT']."/lib/dbconn.php");
include_once($_SERVER['DOCUMENT_ROOT']."/lib/function.php");
session_start();
//session id post id
//
if($_SESSION['email'] != $_POST['getId']){
	session_destroy();
	unset($_SESSION);
	go_href("Email 아이디가 다릅니다.\\n로그아웃합니다.", "/", "go");
	exit;
}

//old data
$sql  = "select * from tbl_member a join tbl_member_file b on a.mseq=b.mf_meq where m_id='".$_POST['getId']."'";
$query = $db->query($sql);
$old_data = $query->fetch();

$modi_log = $_SESSION['email']."의 변경 내역 : ";
if($_POST['nickname'] != $old_data['m_nick']){
	$modi_log .= " [닉네임 변경] ".$old_data['m_nick']." => ".$_POST['nickname']."\n";
}

if($_POSR['name'] != $_SESSION['name']){
	$modi_log .= " [이름 변경] ".$old_data['m_name']." => ".$_POST['name']."\n";
}

$sql = "update tbl_member set m_nick = :nick, m_name = :name where m_id='".$_POST['getId']."'";
$query = $db->prepare($sql);

try{
	$query->execute(array("nick"=>$_POST['nickname'], "name"=>$_POST['name']));
}catch(PDOException $e){

}

//file check
if(isset($_FILES)){
	$refuse_ext = array("exe", "php", "cpp", "java", "jar", "iso", "html", "css", "js", "php3", "php5", "php7");
	$file = $_FILES['file'];
	$dt_date = date('Ymd', time());
	$file_name = $file['name'];
	$refile_name = $old_data['mseq']."_".$dt_date;
	$size = $file['size'];
	$ext = substr(strrchr($file["name"],"."),1);
	$ext = strtolower($ext);

	$sql = "update tbl_member_file set mf_file_name='".$file_name.", mf_refile_name='".$refile_name."', mf_file_ext='".$ext."', mf_size='".$size."'
			where mfseq='".$old_data['mfseq']."' and mf_meq='".$old_data['mf_meq']."'";
	$db->query($sql);
}else{

}

session_destroy();
unset($_SESSION);
go_href("회원정보가 변경되었습니다.\\n재로그인 해주시기 바랍니다.", "/page/member/login.php", "go");
?>